<?php

namespace Kirby\Reference\Types;

use Closure;
use Exception;
use Kirby\Reference\Reflectable\Doc;
use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use PHPStan\PhpDocParser\Ast\AbstractNodeVisitor;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\NodeTraverser;
use PHPStan\PhpDocParser\Ast\NodeVisitor\CloningVisitor;
use PHPStan\PhpDocParser\Ast\Type\ArrayShapeItemNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\ObjectShapeItemNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionType;

/**
 * Resolves all type templates/generics
 * from a class and/or function (incl. parents and traits)
 */
class Context
{
	public static array $cache = [];
	public static array $files = [];

	public array $types = [];

	public function __construct(
		public ReflectionClass|null $class = null,
		public ReflectionFunctionAbstract|null $function = null
	) {
		$key = $class?->getName() . '::' . $function?->getName();

		// use cached resolved types if available
		if (isset(static::$cache[$key])) {
			$this->types = static::$cache[$key];
			return;
		}

		// start with the templates of the class and its
		// parent classes/traits, which are resolved once per class
		if ($this->class !== null) {
			$this->types = match ($this->function) {
				null    => $this->resolveClass(),
				default => (new static($this->class))->types
			};
		}

		// resolve method/function docblock if necessary
		if ($this->function !== null) {
			$this->resolveFunction();
		}

		// cache the resolved type templates
		static::$cache[$key] = $this->types;
	}

	/**
	 * Binds the type arguments of a child class to the
	 * templates of this class by their position, e.g.
	 * `Kirby\Cms\Page` from `@extends Collection<Page>`
	 */
	protected function bindArguments(array $arguments): void
	{
		$templates = array_keys($this->types);

		foreach ($arguments as $position => $type) {
			if ($template = $templates[$position] ?? null) {
				$this->types[$template] = $type;
			}
		}
	}

	/**
	 * Declares the templates of a docblock, with their
	 * bound as type until a more specific type is known,
	 * e.g. `Kirby\Cms\Page` for `@template TValue of Page`
	 */
	protected function declareTemplates(Doc $doc, string|null $file): void
	{
		foreach ($doc->getTemplates() as $template) {
			$bound = $template->bound;
			$bound = $bound ? Types::print($this->resolveNode($bound, $file)) : null;

			$this->types[$template->name] ??= $bound;
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
				class: new ReflectionClass($reflectable->class),
				function: $reflectable->reflection
			);
		}

		if ($reflectable instanceof ReflectableFunction) {
			return new static(function: $reflectable->reflection);
		}

		throw new Exception('Invalid reflectable for creating context');
	}

	/**
	 * Returns the namespace and the class names imported
	 * via `use` statements (keyed by their alias) of a file
	 *
	 * @return array{string, array<string, string>}
	 */
	protected static function file(string $file): array
	{
		if (isset(static::$files[$file]) === true) {
			return static::$files[$file];
		}

		$code = file_get_contents($file);

		preg_match('/^namespace\s+([\w\\\\]+)\s*;/m', $code, $namespace);

		// only top-level imports start at the beginning of
		// the line; trait `use` statements are indented
		preg_match_all(
			'/^use\s+([\w\\\\]+)(?:\s+as\s+(\w+))?\s*;/m',
			$code,
			$matches,
			PREG_SET_ORDER
		);

		$imports = [];

		foreach ($matches as $match) {
			$name  = ltrim($match[1], '\\');
			$parts = explode('\\', $name);
			$alias = $match[2] ?? end($parts);

			$imports[$alias] = $name;
		}

		return static::$files[$file] = [$namespace[1] ?? '', $imports];
	}

	/**
	 * Infers the templates that are still unknown from the
	 * native PHP type hint, if they make up the docblock type
	 * (or one of its union members), e.g. `@param TValue $a`
	 * with `int $a`
	 */
	protected function inferFromNative(
		TypeNode $type,
		ReflectionType|null $native
	): void {
		foreach (Types::flatten($type) as $node) {
			if (
				$node instanceof IdentifierTypeNode &&
				array_key_exists($node->name, $this->types) === true
			) {
				$this->types[$node->name] ??= Types::from($native ?? 'mixed')->toString();
			}
		}
	}

	/**
	 * Resolves a single template to a type, if available
	 */
	public function resolve(string $name): string
	{
		if (array_key_exists($name, $this->types) === true) {
			return $this->types[$name] ?? 'mixed';
		}

		return $name;
	}

	/**
	 * Iterate though parent classes and traits
	 * using generics to build a complete template => type map
	 */
	public function resolveClass(array $arguments = []): array
	{
		$doc  = Doc::factory($this->class);
		$file = $this->class->getFileName() ?: null;

		// declare the templates of the class/trait
		$this->declareTemplates($doc, $file);

		// bind the type arguments from the child class
		$this->bindArguments($arguments);

		// recursively resolve all parent classes
		foreach ($doc->getExtendsTagValues() as $extends) {
			$this->resolveParent($extends->type, $file);
		}

		// recursively resolve all used traits
		foreach ($doc->getUsesTagValues() as $use) {
			$this->resolveParent($use->type, $file);
		}

		return $this->types;
	}

	/**
	 * Resolve the templates from a function's docblock by
	 * mapping param and return tags to their native PHP type hints
	 */
	public function resolveFunction(): void
	{
		$doc  = Doc::factory($this->function);
		$file = $this->function->getFileName() ?: null;

		// declare the templates of the function
		$this->declareTemplates($doc, $file);

		$params = $this->function->getParameters();

		foreach ($doc->getParamTagValues() as $tag) {
			$param = A::find(
				$params,
				fn ($p) => $p->getName() === ltrim($tag->parameterName, '$')
			);

			$this->inferFromNative($tag->type, $param?->getType());
		}

		if ($return = $doc->getReturnNode()) {
			$this->inferFromNative($return->type, $this->function->getReturnType());
		}
	}

	/**
	 * Resolves a class name from a docblock to its fully
	 * qualified name, using the namespace and imports
	 * of the file the docblock belongs to
	 */
	protected function resolveName(string $name, string|null $file): string
	{
		if (str_starts_with($name, '\\') === true) {
			return ltrim($name, '\\');
		}

		// keep simple types (e.g. `string`) as they are
		if ($file === null || Type::generic($name) !== null) {
			return $name;
		}

		[$namespace, $imports] = static::file($file);

		$first = Str::before($name, '\\') ?: $name;

		if (isset($imports[$first]) === true) {
			return $imports[$first] . substr($name, strlen($first));
		}

		// template names (e.g. `TValue`) and keywords aren't classes
		$class = ltrim($namespace . '\\' . $name, '\\');

		return Identifier::exists($class) === true ? $class : $name;
	}

	/**
	 * Returns a copy of the type with all templates replaced
	 * by their types and all class names resolved to their
	 * fully qualified name, e.g. `list<TValue>` to
	 * `list<Kirby\Cms\Page>`
	 *
	 * @param $file File of the docblock the type belongs to,
	 *             defaults to the file of the function/class
	 */
	public function resolveNode(TypeNode $node, string|null $file = null): TypeNode
	{
		$file ??= $this->function?->getFileName() ?: $this->class?->getFileName() ?: null;

		$visitor = new class (function (Node $node) use ($file) {
			// only the value of a shape item is a type,
			// not its key (e.g. `array{files: Files}`)
			if (
				$node instanceof ArrayShapeItemNode ||
				$node instanceof ObjectShapeItemNode
			) {
				$node->valueType = $this->resolveNode($node->valueType, $file);
				return NodeTraverser::DONT_TRAVERSE_CHILDREN;
			}

			if ($node instanceof IdentifierTypeNode === false) {
				return null;
			}

			if (array_key_exists($node->name, $this->types) === true) {
				return Doc::parseType($this->types[$node->name] ?? 'mixed');
			}

			$node->name = $this->resolveName($node->name, $file);
			return null;
		}) extends AbstractNodeVisitor {

			public function __construct(protected Closure $enter)
			{
			}

			public function enterNode(Node $node): Node|int|null
			{
				return ($this->enter)($node);
			}
		};

		// clone the nodes first, as doc blocks are cached
		$traverser = new NodeTraverser([new CloningVisitor(), $visitor]);
		return $traverser->traverse([$node])[0];
	}

	/**
	 * Resolve a single parent class or trait
	 * to extend the template => type map
	 */
	protected function resolveParent(
		GenericTypeNode $reference,
		string|null $file
	): void {
		$arguments = A::map(
			$reference->genericTypes,
			fn (TypeNode $type) => Types::print($this->resolveNode($type, $file))
		);

		$reflection  = new ReflectionClass($this->resolveName($reference->type->name, $file));
		$context     = new Context(class: $reflection);
		$types       = $context->resolveClass($arguments);
		$this->types = [...$this->types, ...$types];
	}
}
