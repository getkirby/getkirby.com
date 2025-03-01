<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;

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
		'static'    => 'object',
		'self'      => 'object',
		'$this'     => 'object',
		'iterable'  => 'object',
		'resource'  => 'object',
		'null'      => 'null',
		'void'      => 'void',
		'callable'  => 'callable',
		'mixed'     => 'mixed'
	];

	public function __construct(
		public string $type
	) {
	}

	public static function factory(string $type): static {
		// generic simple types
		if (static::generic($type) !== null) {
			return new static($type);
		}

		// identifier types (class names, interfaces, traits)
		return new Identifier($type);
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
