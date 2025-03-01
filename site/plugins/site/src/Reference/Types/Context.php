<?php

namespace Kirby\Reference\Types;

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
 * from a class and its parents
 */
class Context
{
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

	protected function addPayload(array $payload): void
	{
		foreach ($payload as $key => $type) {
			if ($key = array_keys($this->types)[$key] ?? null) {
				$this->types[$key] = $type;
			}
		}
	}

	protected function addTemplates(Doc $doc): void
	{
		foreach ($doc->getTemplates() as $template) {
			$this->types[$template->name] ??= $template->bound;
		}
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

		$this->addTemplates($doc);

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

		// add all types from the class' docblock
		$this->addTemplates($doc);

		$this->addPayload($payload);

		// resolve all parent classes
		if ($extends = $doc->getExtends()) {
			$this->resolveParent($extends);
		}

		// resolve all used traits
		if ($uses = $doc->getUses()) {
			$this->resolveParent($uses);
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
