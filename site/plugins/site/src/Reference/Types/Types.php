<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Toolkit\A;
use PHPStan\PhpDocParser\Ast\Type\ConditionalTypeForParameterNode;
use PHPStan\PhpDocParser\Ast\Type\ConditionalTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use ReflectionType;

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
	 * Returns the members of a union type, incl. both
	 * branches of a conditional type like `($a is true ? int : string)`
	 *
	 * @return array<TypeNode>
	 */
	public static function flatten(TypeNode $node): array
	{
		return match (true) {
			$node instanceof UnionTypeNode
				=> array_merge(...A::map($node->types, static::flatten(...))),
			$node instanceof NullableTypeNode
				=> [...static::flatten($node->type), new IdentifierTypeNode('null')],
			$node instanceof ConditionalTypeNode,
			$node instanceof ConditionalTypeForParameterNode
				=> [...static::flatten($node->if), ...static::flatten($node->else)],
			default
			=> [$node]
		};
	}

	/**
	 * Creates the types from a doc block type,
	 * a native PHP type hint or a string of types
	 */
	public static function from(
		TypeNode|ReflectionType|string|null $type,
		Reflectable|null $reflectable = null
	): static {
		return match (true) {
			$type instanceof TypeNode       => static::fromNode($type, $reflectable),
			$type instanceof ReflectionType => static::fromReflection($type, $reflectable),
			is_string($type)                => static::fromString($type, $reflectable),
			default                         => new static([], $reflectable)
		};
	}

	/**
	 * Creates the types from a doc block type, with all
	 * templates and class names resolved in the context
	 */
	public static function fromNode(
		TypeNode $node,
		Reflectable|null $reflectable = null
	): static {
		if ($reflectable !== null) {
			$node = Context::factory($reflectable)->resolveNode($node);
		}

		$types = A::map(static::flatten($node), static::print(...));
		$types = array_values(array_unique($types));

		return new static(
			types: A::map(
				$types,
				fn ($type) => Type::factory($type, $reflectable)
			),
			reflectable: $reflectable
		);
	}

	/**
	 * Creates the types from a native PHP type hint
	 */
	public static function fromReflection(
		ReflectionType $type,
		Reflectable|null $reflectable = null
	): static {
		// `?string` is short for `string|null`
		$types = preg_replace('/^\?(.+)$/', '$1|null', (string)$type);

		return static::fromString($types, $reflectable);
	}

	/**
	 * Creates the types from a string of types,
	 * e.g. `string|int` or `array<string|int, mixed>|null`
	 */
	public static function fromString(
		string $types,
		Reflectable|null $reflectable = null
	): static {
		return new static(
			types: A::map(
				static::split($types),
				fn ($type) => Type::factory($type, $reflectable)
			),
			reflectable: $reflectable
		);
	}

	/**
	 * Check if the types contain a specific type
	 */
	public function has(string $needle): bool
	{
		return A::some($this->types, fn (Type $type) => $type->is($needle));
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
	 * Converts a type node to a compact string,
	 * e.g. `list<int|string>` instead of `list<(int | string)>`
	 */
	public static function print(TypeNode $node): string
	{
		$type = (string)$node;

		// remove the brackets around unions of simple
		// types, unless they are needed for an array (`(int|string)[]`)
		$type = preg_replace('/\(([\w\\\\-]+(?: \| [\w\\\\-]+)+)\)(?!\[)/', '$1', $type);

		return str_replace(' | ', '|', $type);
	}

	/**
	 * Splits a string of types at its top-level separators,
	 * ignoring separators nested in brackets or quotes,
	 * e.g. `array<string|int, mixed>|null`
	 *
	 * @return array<string>
	 */
	public static function split(
		string $types,
		string $separator = '|'
	): array {
		$chars = mb_str_split($types);
		$parts = [''];
		$depth = 0;
		$quote = null;

		foreach ($chars as $index => $char) {
			if ($char === $separator && $depth === 0 && $quote === null) {
				$parts[] = '';
				continue;
			}

			$parts[count($parts) - 1] .= $char;

			if ($quote !== null) {
				// ignore everything until the closing quote
				if ($char === $quote) {
					$quote = null;
				}
			} elseif (in_array($char, ['"', '\''], true) === true) {
				$quote = $char;
			} elseif (in_array($char, ['(', '<', '[', '{'], true) === true) {
				$depth++;
			} elseif (
				in_array($char, [')', '>', ']', '}'], true) === true &&
				// arrows don't close brackets, e.g. `$page->parent()`
				in_array($chars[$index - 1] ?? null, ['-', '='], true) === false
			) {
				$depth--;
			}
		}

		// trim and remove empty types
		$parts = A::map($parts, fn ($part) => trim($part));
		return array_values(A::filter($parts, fn ($part) => $part !== ''));
	}

	/**
	 * Convert the types to HTML
	 * with links to the reference page for objects
	 */
	public function toHtml(
		bool $linked = true,
		string|null $text = null,
		string|null $fallback = null
	): string {
		// Get HTML representation for each type
		$types = [];
		$texts = static::split($text ?? '');

		foreach ($this->types as $index => $type) {
			$types[] = $type->toHtml(
				text: $texts[$index] ?? null,
				linked: $linked
			);
		}

		// If there are no types, use the fallback (as type HTML itself)
		if (count($types) === 0 && $fallback !== null) {
			return Type::factory($fallback)->toHtml(linked: $linked);
		}

		// Remove duplicates
		$types = array_unique($types);

		// Combine into a single string
		return implode('<span class="px-1 color-gray-400" aria-hidden="true">|</span><span class="sr-only">or</span>', $types);
	}

	/**
	 * Convert the types to a string
	 */
	public function toMarkdown(string|null $fallback = null): string
	{
		// If there are no types, use the fallback (as type HTML itself)
		if (count($this->types) === 0 && $fallback !== null) {
			return Type::factory($fallback)->toMarkdown();
		}

		// Get string representation for each type
		$types = A::map($this->types, fn (Type $type) => $type->toMarkdown());

		// Remove duplicates
		$types = array_unique($types);

		if (count($types) === 1) {
			return $types[0];
		}

		// get the last item and remove it from the array
		$last = array_pop($types);

		// Combine into a single string
		return implode(', ', $types) . ' or ' . $last;
	}

	/**
	 * Convert the types to a string
	 */
	public function toString(): string
	{
		// Get string representation for each type
		$types = A::map($this->types, fn (Type $type) => $type->toString());

		// Remove duplicates
		$types = array_unique($types);

		// Combine into a single string
		return implode('|', $types);
	}
}
