<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Types\Types;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\TypelessParamTagValueNode;
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
		ParamTagValueNode|TypelessParamTagValueNode|null $doc = null,
		Reflectable|null $context = null
	): static {
		$name    = $parameter?->getName();
		$name  ??= ltrim($doc?->parameterName, '$');
		// a typeless `@param $name Description` carries no type,
		// so the native type hint is used instead
		$types   = $doc instanceof ParamTagValueNode ? $doc->type : null;
		$types ??= $parameter?->getType();
		// a parameter without any type at all accepts anything
		$types ??= 'mixed';
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

		return static::formatDefault($parameter->getDefaultValue());
	}

	/**
	 * Turns a default value into its readable string representation
	 */
	public static function formatDefault(mixed $default = null): string
	{
		if (is_object($default) === true) {
			return 'new ' . $default::class . '()';
		}

		if (is_array($default) === true) {
			return static::formatDefaultArray($default);
		}

		return str_replace('NULL', 'null', var_export($default, true));
	}

	/**
	 * Turns an array default into a compact single-line
	 * short array syntax, e.g. `['size' => 1, 'unit' => 'day']`,
	 * as `var_export()` would be far too verbose for a table cell
	 */
	protected static function formatDefaultArray(array $default): string
	{
		$isList = array_is_list($default);
		$items  = [];

		foreach ($default as $key => $value) {
			$item = static::formatDefault($value);

			// the keys of a plain list add no information
			if ($isList === false) {
				$item = static::formatDefault($key) . ' => ' . $item;
			}

			$items[] = $item;
		}

		return '[' . implode(', ', $items) . ']';
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
