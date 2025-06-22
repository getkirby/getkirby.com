<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;
use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\ReflectableClassMethod;

/**
 * A single type
 */
class Type
{
	protected static array $types = [
		'string'    => 'string',
		'int'       => 'int',
		'integer'   => 'int',
		'float'     => 'float',
		'number'    => 'number',
		'double'    => 'number',
		'bool'      => 'bool',
		'boolean'   => 'bool',
		'false'     => 'bool',
		'true'      => 'bool',
		'array'     => 'array',
		'object'    => 'object',
		'iterable'  => 'object',
		'resource'  => 'object',
		'null'      => 'null',
		'void'      => 'void',
		'callable'  => 'callable',
		'mixed'     => 'mixed'
	];

	public function __construct(
		public string $type,
		public string|null $alias = null
	) {
	}

	public static function factory(
		string $type,
		Reflectable|null $reflectable = null
	): static {
		// generic simple types
		if (static::generic($type) !== null) {
			return new static($type);
		}

		// assume, it’s a chain
		if (preg_match('/' . Chain::SEPARATORS . '/', $type) === 1) {
			return new Chain($type);
		}

		// identifier types (class names, interfaces, traits)
		if (in_array($type, ['self', 'static', '$this']) === true) {
			if ($reflectable instanceof ReflectableClass) {
				$alias = $type;
				$type  = $reflectable->name(short: false);
			} else if ($reflectable instanceof ReflectableClassMethod) {
				$alias = $type;
				$type  = $reflectable->class;
			}
		}

		return new Identifier($type, $alias ?? null);
	}

	/**
	 * Get the generic type of a type
	 */
	public static function generic(string $type): string|null
	{
		if ($generic = static::$types[$type] ?? null) {
			return $generic;
		};

		if (
			(
				str_starts_with($type, '\'') === true &&
				str_ends_with($type, '\'') === true
			) ||
			(
				str_starts_with($type, '"') === true &&
				str_ends_with($type, '"') === true
			)
		) {
			return 'string';
		}

		if (
			str_starts_with($type, '[') === true &&
			str_ends_with($type, ']') === true
		) {
			return 'array';
		}

		return null;
	}

	public function is(string $type): bool
	{
		return $this->type === $type || $this->alias === $type;
	}

	/**
	 * Return the type as an HTML code tag
	 */
	public function toHtml(
		string|null $text = null,
		bool $linked = true
	): string
	{
		$text ??= $this->toString();

		return Html::tag('code', $text, [
			'class' => 'type type-' . static::generic($this->type) ?? null
		]);
	}

	/**
	 * Return the type as a string
	 */
	public function toString(): string
	{
		return $this->type;
	}
}
