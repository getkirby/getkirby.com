<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Blueprint\Section;
use Kirby\Reference\Reflectable\Tags\Parameter;
use Kirby\Reference\Reflectable\Tags\Parameters;

/**
 * Reflectable for the blueprint options of a panel section
 *
 * @todo Remove together with the sections reference once
 *       sections have been removed from the core
 */
class ReflectableSectionOptions extends Reflectable
{
	public function __construct(
		public string $name,
		public Parameters $parameters
	) {
	}

	public static function factory(string $name): static
	{
		// load props from definition
		$definition = Section::setup($name);
		$props      = $definition['props'] ?? [];
		$parameters = [];

		// for each prop, create a parameter object
		foreach ($props as $attr => $prop) {
			if ($attr === 'value') {
				continue;
			}

			// if the prop is not callable, skip it
			if (is_callable($prop) === false) {
				continue;
			}

			// we use the ReflectableFunction class to get the
			// first parameter of the prop closure
			$reflectable = new ReflectableFunction($prop);
			$parameter   = $reflectable->parameters()->data[0] ?? null;

			if ($parameter !== null) {
				// we remove null as type as usually all
				// options are optional and this would
				// leave the table a lot more cluttered than needed
				$types = $parameter->types();
				$types = $types->not('null');

				$parameters[$attr] = new Parameter(
					name:        $attr,
					types:       $types,
					default:     $parameter->default(),
					description: $reflectable->summary(),
					isRequired:  $parameter->isRequired(),
					prefix:      '' // suppress the leading $
				);
			}
		}

		// sort the parameters by name
		ksort($parameters);

		return new static(
			name: $name,
			parameters: new Parameters($parameters)
		);
	}

	public function parameters(): Parameters
	{
		return $this->parameters;
	}
}
