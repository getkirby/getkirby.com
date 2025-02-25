<?php

namespace Kirby\Reference\Types;

use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use phpDocumentor\Reflection\Type as DocumentorType;
use phpDocumentor\Reflection\Types\AggregatedType;
use ReflectionType;
use ReflectionUnionType;

class Types
{
	/**
	 * @param array<Type> $types
	 */
	public function __construct(
		public array $types
	) {
	}

	public function count(): int
	{
		return count($this->types);
	}

	public static function factory(
		ReflectionType|DocumentorType|string|null $types = null
	): static {
		$types ??= [];

		if (is_string($types) === true) {
			$types = Str::split($types, '|');
			$types = A::map($types, fn ($type) => Type::factory($type));
			return new static($types);
		}

		if ($types instanceof ReflectionUnionType) {
			$types = $types->getTypes();
		}

		if ($types instanceof AggregatedType) {
			$types = iterator_to_array($types->getIterator());
		}

		// ensure types is an array
		$types = A::wrap($types);

		// check if we need to add `null` to the types
		foreach ($types as $type) {
			// if there is a mixed type, we don't need to add null
			if ((string)$type === 'mixed') {
				$null = false;
				break;
			}

			// if the type allows null, we need to add it
			if (method_exists($type, 'allowsNull') && $type->allowsNull()) {
				$null = true;
			}
		}

		// if there is a nullable type, add it
		if ($null ?? false === true) {
			$types[] = 'null';
		}

		$types = A::map($types, fn ($type) => Type::factory(ltrim($type, '?')));

		return new static($types);
	}

	public function has(string $type): bool
	{
		return strpos($this->toString(), $type) !== false;
	}

	public function toHtml(
		bool $linked = true,
		string|null $fallback = null
	): string {
		$types = A::map(
			$this->types,
			fn (Type $type) => $type->toHtml(linked: $linked)
		);
		$types = array_unique($types);

		// if there are no types, use the fallback (as Type HTML itself)
		if (count($types) === 0 && $fallback !== null) {
			return Type::factory($fallback)->toHtml(linked: $linked);
		}

		return implode('<span class="px-1">|</span>', $types);
	}

	public function toString(): string
	{
		$types = A::map($this->types, fn (Type $type) => $type->toString());
		$types = array_unique($types);
		return implode('|', $types);
	}
}
