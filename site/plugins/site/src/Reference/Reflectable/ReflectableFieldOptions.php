<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Parameter;
use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Types\Types;
use Kirby\Reflection\Constructor;
use ReflectionClass;
use ReflectionParameter;
use Throwable;

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

		// `legacy-*` fields still point to an array definition file
		if (is_string($class) === false || class_exists($class) === false) {
			throw new Exception('Field "' . $name . '" not found');
		}

		$reflection  = new ReflectionClass($class);
		$constructor = new Constructor($class);
		$parameters  = [];

		// two bare instances, only differing in the field name,
		// let us read the effective defaults from the getters
		// while filtering out values derived from the field itself
		try {
			$probes = [
				$reflection->newInstance(name: 'a'),
				$reflection->newInstance(name: 'b')
			];
		} catch (Throwable) {
			$probes = null;
		}

		foreach ($constructor->getAllParameters() as $parameter) {
			$option = $parameter->getName();

			// the name isn't written as an option;
			// it comes from the blueprint key
			if ($option === 'name') {
				continue;
			}

			$parameters[$option] = static::parameter(
				$reflection,
				$parameter,
				$probes
			);
		}

		ksort($parameters);

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
		ReflectionClass $reflection,
		ReflectionParameter $parameter,
		array|null $probes = null
	): Parameter {
		$option = $parameter->getName();

		// the description lives in the doc block of the property
		$property = null;

		if ($reflection->hasProperty($option) === true) {
			$property = new ReflectableProperty($reflection->getName(), $option);
		}

		// all options are optional, so `null` would only
		// clutter up the type column
		$types = Types::factory($parameter->getType())->not('null');

		return new Parameter(
			name:        $option,
			types:       $types,
			default:     static::default($reflection, $option, $probes),
			description: $property?->summary(),
			prefix:      ''
		);
	}

	/**
	 * Returns the effective default of an option
	 */
	protected static function default(
		ReflectionClass $reflection,
		string $option,
		array|null $probes = null
	): string|null {
		if ($probes === null || $reflection->hasMethod($option) === false) {
			return null;
		}

		$method = $reflection->getMethod($option);

		try {
			$a = $method->invoke($probes[0]);
			$b = $method->invoke($probes[1]);
		} catch (Throwable) {
			// some getters rely on a model or other state
			// that a bare instance doesn't have
			return null;
		}

		// the getter derives its value from the field itself
		// (e.g. `label` falls back to a label built from the
		// name), so there is no static default to document
		if ($a !== $b) {
			return null;
		}

		return Parameter::formatDefault($a);
	}

	public function parameters(): Parameters
	{
		return $this->parameters;
	}
}
