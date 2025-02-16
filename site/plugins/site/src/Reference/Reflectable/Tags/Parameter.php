<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Types\Types;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use ReflectionParameter;

class Parameter
{
	public function __construct(
		public string $name,
		public Types $types,
		public string|null $default = null,
		public string|null $description = null,
		public bool $isRequired = false,
		public bool $isVariadic = false
	) {
	}

	public function default(): string|null
	{
		return $this->default;
	}

	public function description(): string|null
	{
		return $this->description;
	}

	public static function factory(
		ReflectionParameter $parameter,
		Param|null $doc = null
	): static {
		$name    = $parameter->getName();
		$types   = $parameter->getType();
		$types ??= $doc?->getType();
		$types   = Types::factory($types);

		if ($parameter->isOptional() === true) {
			if ($parameter->isDefaultValueAvailable()) {
				$default = $parameter->getDefaultValue();
				$default = var_export($default, true);
				$default = str_replace('NULL', 'null', $default);
				$default = str_replace('array (' . PHP_EOL . ')', '[ ]', $default);
			}
		}

		return new static(
			name:        $name,
			types:       $types,
			default:     match ($default ?? null) {
				'null', null  => null,
				default       => $default
			},
			description: $doc?->getDescription()?->getBodyTemplate(),
			isRequired:  $parameter->isOptional() === false,
			isVariadic:  $parameter->isVariadic()
		);
	}

	public function hasDescription(): bool
	{
		return empty($this->description) !== true;
	}

	public function isRequired(): bool
	{
		return $this->isRequired;
	}

	public function isVariadic(): bool
	{
		return $this->isVariadic;
	}

	public function name(): string
	{
		return '$' . $this->name;
	}

	public function toString(): string
	{
		$string = $this->name();

		if ($this->isVariadic === true) {
			$string = '...' . $string;
		}

		$string = trim($this->types->toString() . ' ' . $string);

		if ($this->default !== null) {
			$string .= ' = ' . $this->default;
		}

		return $string;
	}

	public function types(): Types
	{
		return $this->types;
	}
}
