<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;
use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
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
		public array $types,
		public Reflectable|null $reflectable = null
	) {
	}

	/**
	 * Returns the number of types
	 */
	public function count(): int
	{
		return count($this->types);
	}

	/**
	 * Create a new Types instance from either a PHP reflection type,
	 * a PHPStan type node or a simple string.
	 *
	 * A context can be provided to resolve type templates.
	 */
	public static function factory(
		ReflectionType|TypeNode|string|null $types = null,
		Reflectable|null $reflectable = null
	): static {
		$types ??= [];

		// Handle simple strings first;
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

		// Ensure types is an array
		$types = A::wrap($types);

		// If there is a nullable type, add it
		if (static::needsNull($types) === true) {
			$types[] = 'null';
		}

		// Remove the optional `?` from the type strings
		$types = A::map($types, fn ($type) => ltrim($type, '?'));

		// Resolve type templates if a context is provided
		if ($reflectable !== null) {
			$context = Context::factory($reflectable);
			$types   = A::map(
				$types,
				fn ($type) => Str::split($context->resolve($type), '|')
			);
			$types = array_merge(...$types);
		}

		// Create a new Type instance for each type string
		$types = array_unique($types);
		$types = A::map($types, fn ($type) => Type::factory($type));

		return new static($types, $reflectable);
	}

	/**
	 * Check if the types contain a specific type
	 */
	public function has(string $type): bool
	{
		return strpos($this->toString(replaceSelf: false), $type) !== false;
	}

	/**
	 * Check if the types require to add a null type
	 */
	protected static function needsNull(array $types): bool
	{
		$needsNull = false;

		foreach ($types as $type) {
			// If there is a mixed type, we don't need to add null
			if ((string)$type === 'mixed') {
				return false;
			}

			// If the type allows null, we need to add it
			if (method_exists($type, 'allowsNull') && $type->allowsNull()) {
				$needsNull = true;
			}
		}

		return $needsNull ?? false;
	}

	/**
	 * Remove a type from the collection
	 */
	public function not(string $type): static
	{
		return new static(
			types: A::filter(
				$this->types,
				fn (Type $t) => $t->type !== $type
			),
			reflectable: $this->reflectable
		);
	}

	/**
	 * Replace self/static/$this with the actual class name
	 */
	protected function replaceSelf(
		string $string,
		bool $html = false,
		bool $linked = true
	): string {
		if ($this->reflectable === null) {
			return $string;
		}

		// Get the class name
		if ($this->reflectable instanceof ReflectableClass) {
			$type = $this->reflectable->name(short: false);
		} else if ($this->reflectable instanceof ReflectableClassMethod) {
			$type = $this->reflectable->class;
		}

		$type    = Type::factory($type ?? 'static');
		$needles = ['static', 'self', '$this'];

		// If HTML is requested, wrap the needles in code tags
		if ($html === true) {
			$needles = A::map(
				$needles,
				fn ($needle) => Html::tag('code', $needle, [
					'class' => 'type type-object'
				])
			);
		}

		$result = match ($html) {
			true  => $type->toHtml(linked: $linked),
			false => $type->toString()
		};

		return str_replace($needles, $result, $string);
	}

	/**
	 * Convert the types to HTML
	 * with links to the reference page for objects
	 */
	public function toHtml(
		bool $linked = true,
		string|null $fallback = null
	): string {
		// Get HTML representation for each type
		$types = A::map(
			$this->types,
			fn (Type $type) => $type->toHtml(linked: $linked)
		);

		// If there are no types, use the fallback (as type HTML itself)
		if (count($types) === 0 && $fallback !== null) {
			return Type::factory($fallback)->toHtml(linked: $linked);
		}

		// Replace self/static/$this with the actual class name
		$types = A::map($types, fn ($type) => $this->replaceSelf($type,  html: true, linked: $linked));
		// Remove duplicates
		$types = array_unique($types);
		// Combine into a single string
		return implode('<span class="px-1 color-gray-400" aria-hidden="true">|</span><span class="sr-only">or</span>', $types);
	}

	/**
	 * Convert the types to a string
	 */
	public function toString(bool $replaceSelf = true): string
	{
		// Get string representation for each type
		$types = A::map($this->types, fn (Type $type) => $type->toString());

		// Replace self/static/$this with the actual class name
		if ($replaceSelf === true) {
			$types = A::map($types, fn ($type) => $this->replaceSelf($type));
		}

		// Remove duplicates
		$types = array_unique($types);
		// Combine into a single string
		return implode('|', $types);
	}
}
