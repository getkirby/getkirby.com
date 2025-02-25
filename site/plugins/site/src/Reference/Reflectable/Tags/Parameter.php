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

		return new static(
			name:        $name,
			types:       $types,
			default:     static::factoryDefault($parameter),
			description: $doc?->getDescription()?->getBodyTemplate(),
			isRequired:  $parameter->isOptional() === false,
			isVariadic:  $parameter->isVariadic()
		);
	}

	/**
	 * Returns the default value of the parameter
	 */
	protected static function factoryDefault(
		ReflectionParameter $parameter
	): string|null {
		// if the parameter is not optional, there is no default value
		if ($parameter->isOptional() === false) {
			return null;
		}

		// if the parameter does not have a default value, return null
		if ($parameter->isDefaultValueAvailable() === false) {
			return null;
		}

		// get the default value and clean it up
		$default = $parameter->getDefaultValue();
		$default = var_export($default, true);
		$default = str_replace('NULL', 'null', $default);
		$default = str_replace('array (' . PHP_EOL . ')', '[ ]', $default);

		if ($default === null || $default === 'null') {
			return null;
		}

		return $default;
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

		// combine the types and the name
		$string = trim($this->types->toString() . ' ' . $string);

		// if there is a default value, add it
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
