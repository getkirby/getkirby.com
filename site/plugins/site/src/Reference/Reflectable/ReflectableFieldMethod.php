<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Content\Field;
use ReflectionMethod;

/**
 * Reflectable for a field method
 */
class ReflectableFieldMethod extends ReflectableClassMethod
{
	public function __construct(
		public string $method
	) {
		$this->class = Field::class;

		if (method_exists(Field::class, $this->method) === false) {
			throw new Exception('Field method "' . $this->method . '" not found');
		}

		$this->reflection = new ReflectionMethod(Field::class, $this->method);
	}
}
