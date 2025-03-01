<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;

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
		'callable'  => 'mixed',
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

	public static function generic(string $type): string|null
	{
		$generic = static::$types[$type] ?? null;

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
			$generic ??= 'string';
		}

		return $generic;
	}

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

	public function toString(): string
	{
		return $this->type;
	}
}
