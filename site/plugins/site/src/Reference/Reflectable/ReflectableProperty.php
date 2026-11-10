<?php

namespace Kirby\Reference\Reflectable;

use ReflectionProperty;

/**
 * Reflectable for a class property
 */
class ReflectableProperty extends Reflectable
{
	public function __construct(
		public string $class,
		public string $property
	) {
		$this->reflection = new ReflectionProperty($class, $property);
	}

	/**
	 * Returns the name of the property
	 */
	public function name(): string
	{
		return $this->property;
	}
}
