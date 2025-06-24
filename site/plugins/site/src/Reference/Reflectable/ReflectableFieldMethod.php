<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Types\Identifier;
use ReflectionFunction;
use ReflectionMethod;

/**
 * Reflectable for a field method
 */
class ReflectableFieldMethod extends ReflectableClassMethod
{
	public function __construct(
		public string $method
	) {
		$this->class  = Field::class;
		$this->method = strtolower($method);

		if ($method = Field::$methods[$this->method] ?? null) {
			// method is defined in `kirby/config/methods.php`
			$this->reflection = new ReflectionFunction($method);
		} else if (method_exists(Field::class, $this->method) === true) {
			// method is defined in the `Field` class
			$this->reflection = new ReflectionMethod(Field::class, $this->method);
		} else {
			throw new Exception('Field method "' . $this->method . '" not found');
		}
	}

	/**
	 * Returns name aliases of the field method
	 */
	public function aliases(): array
	{
		return array_keys(Field::$aliases, $this->method);
	}

	/**
	 * Returns the parameters of the field method
	 */
	public function parameters(): Parameters
	{
		// Kirby automatically inserts $field as first parameter on all methods
		// defined in `kirby/config/methods.php`. The reflection picks up this
		// parameter, however, we need to remove it from the list.
		return $this->parameters ??= Parameters::factory($this)->not('field');
	}

	/**
	 * Returns the path to the source code of the field method
	 */
	protected function sourcePath(): string
	{
		if ($this->reflection instanceof ReflectionMethod) {
			return 'src/Content/Field.php';
		}

		return 'config/methods.php';
	}
}
