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
use ReflectionClass;
use ReflectionFunctionAbstract;

/**
 * Resolves all type templates/generics
 * from a class and/or function (incl. parents and traits)
 */
class Context
{
	public static array $cache = [];
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
	 * Resolves a single template to a type, if available
	 */
	public function resolve(string $name): string
	{
		return $this->types[$name] ?? $name;
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
	 * Resolve a single parent class or trait
	 * to extend the template => type map
	 */
	protected function resolveParent(GenericTypeNode $reference): void
	{
		$payload = A::map(
			$reference->genericTypes,
			fn ($type) => $this->types[$type->name] ?? $type->name
		);

		$reflection  = new ReflectionClass($reference->type->name);
		$context     = new Context(class: $reflection);
		$types       = $context->resolveClass($payload);
		$this->types = [...$this->types, ...$types];
	}
}
