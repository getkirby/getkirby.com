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
class ReflectableFieldMethod extends ReflectableFunction
{
	public function __construct(
		public string $name
	) {
		$name = strtolower($name);

		if ($method = Field::$methods[$name] ?? null) {
			// method is defined in `kirby/config/methods.php`
			$this->reflection = new ReflectionFunction($method);
		} else if (method_exists(Field::class, $name) === true) {
			// method is defined in the `Field` class
			$this->reflection = new ReflectionMethod(Field::class, $name);
		} else {
			throw new Exception('Field method "' . $name . '" not found');
		}
	}

	/**
	 * Returns name aliases of the field method
	 */
	public function aliases(): array
	{
		return array_keys(Field::$aliases, $this->name);
	}

	/**
	 * TODO: cleaner implementation, this is a quick fix
	 */
	public function class(
		bool $short = false
	): string|Identifier {
		$class = match ($short) {
			true  => 'Field',
			false => 'Kirby\Content\Field',
		};

		return $class;
	}

	/**
	 * Returns the name of the field method
	 */
	public function name(): string
	{
		return '$field->' . $this->name;
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
