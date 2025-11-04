<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Types\Types;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use ReflectionParameter;

/**
 * Represents a single parameter of a function or method
 * incl. its types, default value and description
 */
class Parameter
{
	public function __construct(
		public string $name,
		public Types $types,
		public string|null $default = null,
		public string|null $description = null,
		public bool $isRequired = false,
		public bool $isVariadic = false,
		public string $prefix = '$'
	) {
	}

	/**
	 * Returns the default value of the parameter
	 */
	public function default(): string|null
	{
		return $this->default;
	}

	/**
	 * Returns the description of the parameter
	 */
	public function description(): string|null
	{
		return $this->description;
	}

	public static function factory(
		ReflectionParameter|null $parameter = null,
		ParamTagValueNode|null $doc = null,
		Reflectable|null $context = null
	): static {
		$name    = $parameter?->getName();
		$name  ??= ltrim($doc?->parameterName, '$');
		$types   = $doc?->type;
		$types ??= $parameter?->getType();
		$types   = Types::factory($types, $context);

		return new static(
			name:        $name,
			types:       $types,
			default:     static::factoryDefault($parameter),
			description: $doc?->description,
			isRequired:  $parameter?->isOptional() !== true &&
						 $types->has('null') !== true,
			isVariadic:  $parameter?->isVariadic() ?? $doc?->isVariadic
		);
	}

	/**
	 * Retrieves the default value of a parameter
	 */
	protected static function factoryDefault(
		ReflectionParameter|null $parameter = null
	): string|null {
		if ($parameter === null) {
			return null;
		}

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
			return 'null';
		}

		return $default;
	}

	/**
	 * Returns whether the parameter has a description
	 */
	public function hasDescription(): bool
	{
		return empty($this->description) !== true;
	}

	/**
	 * Returns whether the parameter is required
	 */
	public function isRequired(): bool
	{
		return $this->isRequired;
	}

	/**
	 * Returns whether the parameter is variadic
	 */
	public function isVariadic(): bool
	{
		return $this->isVariadic;
	}

	/**
	 * Returns the name of the parameter
	 * with a leading $ and … if it is variadic
	 */
	public function name(): string
	{
		$name = $this->prefix . $this->name;

		if ($this->isVariadic() === true) {
			$name = '...' . $name;
		}

		return $name;
	}

	/**
	 * Returns the string representation of the parameter
	 * with the types, the name and the default value
	 */
	public function toString(): string
	{
		$string = $this->name();

		// combine the types and the name
		$string = trim($this->types->toString() . ' ' . $string);

		// if there is a default value, add it
		if ($this->default !== null) {
			$string .= ' = ' . $this->default;
		}

		return $string;
	}

	/**
	 * Returns the types of the parameter
	 */
	public function types(): Types
	{
		return $this->types;
	}
}
