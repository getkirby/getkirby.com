<?php

namespace Kirby\Reference\Types;

use Exception;
use Kirby\Reference\Reflectable\Doc;
use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use ReflectionClass;
use ReflectionFunctionAbstract;

/**
 * Resolves all type templates/generics
 * from a class and/or function (incl. parents and traits)
 */
class Context
{
	public static array $cache = [];

	/**
	 * Cache for the imported class names per file
	 */
	public static array $imports = [];

	public array $types = [];

	public function __construct(
		public ReflectionClass|null $class = null,
		public ReflectionFunctionAbstract|null $function = null
	) {
		$key = $class?->getName() . $function?->getName();

		// use cached resolved types if available
		if (isset(static::$cache[$key])) {
			$this->types = static::$cache[$key];
			return;
		}

		// try resolving all types from parent classes/traits
		if ($this->class) {
			$this->resolveClass();
		}

		// resolve method/function docblock if necessary
		if ($this->function) {
			$this->resolveFunction();
		}

		// cache the resolved type templates
		static::$cache[$key] = $this->types;
	}

	/**
	 * Update type map from array of already resolved types
	 */
	protected function addPayload(array $payload): void
	{
		foreach ($payload as $key => $type) {
			if ($key = array_keys($this->types)[$key] ?? null) {
				$this->types[$key] = $type;
			}
		}
	}

	/**
	 * Add all templates from the docblock to the type map
	 */
	protected function addTemplates(Doc $doc): void
	{
		foreach ($doc->getTemplates() as $template) {
			$this->types[$template->name] ??= $template->bound;
		}
	}

	public static function factory(
		Reflectable $reflectable
	): static {
		if ($reflectable instanceof ReflectableClass) {
			return new static(class: $reflectable->reflection);
		}

		if ($reflectable instanceof ReflectableClassMethod) {
			return new static(
				class:    new ReflectionClass($reflectable->class),
				function: $reflectable->reflection
			);
		}

		if ($reflectable instanceof ReflectableFunction) {
			return new static(function: $reflectable->reflection);
		}

		throw new Exception('Invalid reflectable for creating context');
	}

	/**
	 * Returns the class names imported via `use`
	 * statements in the file of the given class,
	 * keyed by their (aliased) short name
	 */
	protected static function imports(ReflectionClass $class): array
	{
		$file = $class->getFileName();

		if ($file === false) {
			return [];
		}

		if (isset(static::$imports[$file]) === true) {
			return static::$imports[$file];
		}

		$imports = [];

		// only top-level imports start at the beginning of
		// the line; trait `use` statements are indented
		preg_match_all(
			'/^use\s+([\w\\\\]+)(?:\s+as\s+(\w+))?\s*;/m',
			file_get_contents($file),
			$matches,
			PREG_SET_ORDER
		);

		foreach ($matches as $match) {
			$name  = ltrim($match[1], '\\');
			$parts = explode('\\', $name);
			$alias = $match[2] ?? end($parts);

			$imports[$alias] = $name;
		}

		return static::$imports[$file] = $imports;
	}

	/**
	 * Resolves a single template to a type, if available
	 */
	public function resolve(string $name): string
	{
		return $this->types[$name] ?? $name;
	}

	/**
	 * Iterate though parent classes and traits
	 * using generics to build a complete template => type map
	 */
	public function resolveClass(array $payload = []): array
	{
		$doc = Doc::factory($this->class);

		// add all types from the class'/trait's docblock
		$this->addTemplates($doc);

		// inject already resolved types
		$this->addPayload($payload);

		// recursively resolve all parent classes
		foreach ($doc->getExtendsTagValues() as $extends) {
			$this->resolveParent($extends->type);
		}

		// recursively resolve all used traits
		foreach ($doc->getUsesTagValues() as $use) {
			$this->resolveParent($use->type);
		}

		return $this->types;
	}

	/**
	 * Resolve the templates from a function's docblock by
	 * mapping param and return tags to their native PHP type hints
	 */
	public function resolveFunction(): void
	{
		$doc = Doc::factory($this->function);

		// collect all templates from the docblock
		$this->addTemplates($doc);

		// loop though all docblock param tags to see
		// if the templates are used here; if so,
		// map the template to the native PHP type hint
		// for the given parameter
		$params = $this->function->getParameters();

		foreach ($doc->getParamTagValues() as $tag) {
			$types = $tag->type;
			$types = trim($types, '()');
			$types = Str::split($types, '|');

			foreach ($types as $name) {
				if (array_key_exists($name, $this->types)) {
					$native = A::find(
						$params,
						fn ($p) => $p->getName() === ltrim($tag->parameterName, '$')
					);

					$type = $native->getType() ?? 'mixed';
					$this->types[$name] ??= Types::factory($type)->toString();
				}
			}
		}

		// check the docblock return tag to see
		// if the templates are used here; if so,
		// map the template to the native return PHP type hint
		if ($return = $doc->getReturnNode()?->type) {
			$return = trim($return, '()');
			$return = Str::split($return, '|');

			foreach ($return as $name) {
				if (array_key_exists($name, $this->types)) {
					$type = $this->function->getReturnType() ?? 'mixed';
					$this->types[$name] ??= Types::factory($type)->toString();
				}
			}
		}
	}

	/**
	 * Resolves a class name from a docblock to its fully
	 * qualified name, using the imports and namespace
	 * of the class the docblock belongs to
	 */
	protected function resolveName(string $name): string
	{
		if (str_starts_with($name, '\\') === true || $this->class === null) {
			return ltrim($name, '\\');
		}

		// keep simple types (e.g. `string`) as they are
		if (Type::generic($name) !== null) {
			return $name;
		}

		$first   = Str::before($name, '\\') ?: $name;
		$imports = static::imports($this->class);

		if (isset($imports[$first]) === true) {
			return $imports[$first] . substr($name, strlen($first));
		}

		if ($namespace = $this->class->getNamespaceName()) {
			$class = $namespace . '\\' . $name;

			// template names (e.g. `TValue`) aren't classes
			if (
				class_exists($class) === true ||
				interface_exists($class) === true ||
				trait_exists($class) === true
			) {
				return $class;
			}
		}

		return $name;
	}

	/**
	 * Resolve a single parent class or trait
	 * to extend the template => type map
	 */
	protected function resolveParent(GenericTypeNode $reference): void
	{
		$payload = A::map(
			$reference->genericTypes,
			function ($type) {
				if ($type instanceof UnionTypeNode) {
					$type = $type->types;
				}

				$type = A::map(
					A::wrap($type),
					fn ($t) => $this->types[$t->name] ?? $this->resolveName($t->name)
				);

				return implode('|', $type);
			}
		);

		$reflection  = new ReflectionClass($this->resolveName($reference->type->name));
		$context     = new Context(class: $reflection);
		$types       = $context->resolveClass($payload);
		$this->types = [...$this->types, ...$types];
	}
}
