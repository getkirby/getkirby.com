<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use ReflectionType;
use ReflectionUnionType;

/**
 * Collection of types which can represent
 * either a single type or a union of types
 */
class Types
{
	/**
	 * @param array<Type> $types
	 */
	public function __construct(
		public array $types
	) {
	}

	/**
	 * Create a new Types instance from either a PHP reflection type,
	 * a PHPStan type node or a simple string.
	 *
	 * A context can be provided to resolve type templates.
	 */
	public static function factory(
		ReflectionType|TypeNode|string|null $types = null,
		Reflectable|null $context = null
	): static {
		$types ??= [];

		// handle simple strings first;
		// expect a pipe-separated list of exact types
		if (is_string($types) === true) {
			$types = Str::split($types, '|');
			$types = A::map($types, fn ($type) => Type::factory($type));
			return new static($types);
		}

		if ($types instanceof ReflectionUnionType) {
			$types = $types->getTypes();
		} else if ($types instanceof UnionTypeNode) {
			$types = $types->types;
		}

		// ensure types is an array
		$types = A::wrap($types);

		// if there is a nullable type, add it
		if (static::needsNull($types) === true) {
			$types[] = 'null';
		}

		// remove the optional `?` from the type strings
		$types = A::map($types, fn ($type) => ltrim($type, '?'));

		// resolve type templates if a context is provided
		if ($context) {
			$context = Context::factory($context);
			$types   = A::map(
				$types,
				fn ($type) => Str::split($context->resolve($type), '|')
			);
			$types = array_merge(...$types);
		}

		// create a new Type instance for each type string
		$types = array_unique($types);
		$types = A::map($types, fn ($type) => Type::factory($type));

		return new static($types);
	}

	/**
	 * Check if the types contain a specific type
	 */
	public function has(string $type): bool
	{
		return strpos($this->toString(), $type) !== false;
	}

	/**
	 * Check if the types require to add a null type
	 */
	protected static function needsNull(array $types): bool
	{
		$needsNull = false;

		foreach ($types as $type) {
			// if there is a mixed type, we don't need to add null
			if ((string)$type === 'mixed') {
				return false;
			}

			// if the type allows null, we need to add it
			if (method_exists($type, 'allowsNull') && $type->allowsNull()) {
				$needsNull = true;
			}
		}

		return $needsNull ?? false;
	}

	/**
	 * Remove a type from the collection
	 */
	public function remove(string $type): void
	{
		$this->types = A::filter(
			$this->types,
			fn (Type $t) => $t->type !== $type
		);
	}

	/**
	 * Convert the types to HTML
	 * with links to the reference page for objects
	 */
	public function toHtml(
		bool $linked = true,
		string|null $fallback = null
	): string {
		$types = A::map(
			$this->types,
			fn (Type $type) => $type->toHtml(linked: $linked)
		);
		$types = array_unique($types);

		// if there are no types, use the fallback (as type HTML itself)
		if (count($types) === 0 && $fallback !== null) {
			return Type::factory($fallback)->toHtml(linked: $linked);
		}

		return implode('<span class="px-1 color-gray-400">|</span>', $types);
	}

	/**
	 * Convert the types to a string
	 */
	public function toString(): string
	{
		$types = A::map($this->types, fn (Type $type) => $type->toString());
		$types = array_unique($types);
		return implode('|', $types);
	}
}
