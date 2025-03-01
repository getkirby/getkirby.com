<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\Doc;
use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Toolkit\A;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use ReflectionClass;
use ReflectionFunctionAbstract;
use Reflector;

/**
 * Resolves all type templates/generics
 * from a class and its parents
 */
class Context
{
	public Doc $doc;
	public array $types = [];

	public static $cache = [];

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

	public static function factory(
		Reflectable $reflectable
	): static|null {
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

		return null;
	}

	/**
	 * Resolves a single template to a type, if available
	 */
	public function resolve(string $name): string
	{
		return $this->types[$name] ?? $name;
	}

	public function resolveFunction(): void
	{
		$doc = Doc::factory($this->function);

		foreach ($doc->getTemplates() as $template) {
			$this->types[$template->name] = $template->bound;
		}

		$params = $this->function->getParameters();

		foreach ($doc->getParamTagValues() as $param) {
			if (array_key_exists($param->type->name, $this->types)) {
				$native = A::find(
					$params,
					fn ($p) => $p->getName() === ltrim($param->parameterName, '$')
				);

				$this->types[$param->type->name] = Types::factory($native->getType())->toString();
			}
		}
	}

	/**
	 * Iterate though parent classes and traits
	 * using generics to build a complete template => type map
	 */
	public function resolveClass(array $fill = []): array
	{
		$this->doc = Doc::factory($this->class);

		// add all types from the class' docblock
		foreach ($this->doc->getTemplates() as $template) {
			$this->types[$template->name] = $template->bound;
		}

		// fill in types passed from the child context
		foreach ($fill as $key => $type) {
			$key = array_keys($this->types)[$key];
			$this->types[$key] = $type;
		}

		// resolve all parent classes
		if ($extends = $this->doc->getExtends()) {
			$this->resolveParent($extends);
		}

		// resolve all used traits
		if ($uses = $this->doc->getUses()) {
			$this->resolveParent($uses);
		}

		return $this->types;
	}

	/**
	 * Resolve a single parent class or trait
	 * to extend the template => type map
	 */
	public function resolveParent(GenericTypeNode $reference): void
	{
		$fill = A::map(
			$reference->genericTypes,
			fn ($type) => $this->types[$type->name] ?? $type->name
		);

		$reflection  = new ReflectionClass($reference->type);
		$context     = new Context($reflection);
		$types       = $context->resolveClass($fill);
		$this->types = [...$this->types, ...$types];
	}
}
