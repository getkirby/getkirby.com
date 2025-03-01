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
		if (in_array($type, array_keys(static::$types), true) === true) {
			return new static($type);
		}

		// identifier types (class names, interfaces, traits)
		return new Identifier($type);
	}

	public function toHtml(
		string|null $text = null,
		bool $linked = true
	): string
	{
		$text ??= $this->toString();

		return Html::tag('code', $text, [
			'class' => 'type type-' . static::$types[$this->type] ?? 'mixed'
		]);
	}

	public function toString(): string
	{
		return $this->type;
	}
}
