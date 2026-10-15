<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Parameter;
use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Types\Types;
use Kirby\Reflection\Props;
use ReflectionClass;

/**
 * Reflectable for the blueprint options of a Panel field
 */
class ReflectableFieldOptions extends Reflectable
{
	public function __construct(
		public string $name,
		public string $class,
		public Parameters $parameters
	) {
		$this->reflection = new ReflectionClass($class);
	}

	public static function factory(string $name): static
	{
		$class = App::instance()->core()->fields()[$name] ?? null;

		if (is_string($class) === false || class_exists($class) === false) {
			throw new Exception('Field "' . $name . '" not found');
		}

		$props      = new Props($class);
		$parameters = [];

		foreach ($props->all() as $option => $prop) {
			// the name and type aren't written as options;
			// they come from the blueprint key and select the field
			if ($option === 'name' || $option === 'type') {
				continue;
			}

			$parameters[$option] = static::parameter($props, $option, $prop);
		}

		return new static(
			name:       $name,
			class:      $class,
			parameters: new Parameters($parameters)
		);
	}

	/**
	 * Builds the parameter object for a single field option
	 */
	protected static function parameter(
		Props $props,
		string $option,
		array $prop
	): Parameter {
		$docs = $props->toArray()[$option];

		// a setter may accept more types than the property itself
		$type = match ($prop['setter']) {
			null    => $prop['property']->getType(),
			default => $prop['setter']->getParameters()[0]->getType()
		};

		// all options are optional, so `null` would only
		// clutter up the type column
		$types = Types::factory($type)->not('null');

		// computed options derive their value from the
		// field itself (e.g. `label` falls back to a label
		// built from the name), so there is no static default
		$default = match ($docs['computed']) {
			true    => null,
			default => Parameter::formatDefault($docs['default'])
		};

		return new Parameter(
			name:        $option,
			types:       $types,
			default:     $default,
			description: $docs['description'],
			prefix:      ''
		);
	}

	public function parameters(): Parameters
	{
		return $this->parameters;
	}
}
