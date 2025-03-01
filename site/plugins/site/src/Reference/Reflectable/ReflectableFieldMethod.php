<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\Tags\Parameters;
use ReflectionFunction;
use ReflectionMethod;

class ReflectableFieldMethod extends ReflectableFunction
{
	public function __construct(
		public string $name
	) {
		$name = strtolower($name);

		if ($method = Field::$methods[$name] ?? null) {
			$this->reflection = new ReflectionFunction($method);
		} else if (method_exists(Field::class, $name) === true) {
			$this->reflection = new ReflectionMethod(Field::class, $name);
		} else {
			throw new Exception('Field method "' . $name . '" not found');
		}
	}

	public function aliases(): array
	{
		return array_keys(Field::$aliases, $this->name);
	}

	public function name(): string
	{
		return '$field->' . $this->name;
	}

	public function parameters(): Parameters
	{
		// Kirby automatically inserts $field as first parameter on all methods
		// defined in `kirby/config/methods.php`. The reflection picks up this
		// parameter, however, we need to remove it from the list.
		return $this->parameters ??= Parameters::factory($this)->not('field');
	}

	protected function sourcePath(): string
	{
		return match (true) {
			$this->reflection instanceof ReflectionMethod => 'src/Content/Field.php',
			default                                       => 'config/methods.php',
		};
	}
}
