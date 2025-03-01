<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Reflectable\Tags\Parameter;
use Kirby\Reference\Reflectable\Tags\Parameters;

class ReflectableOptions extends Reflectable
{
	public function __construct(
		public string $type,
		public string $name,
		public Parameters $parameters
	) {
	}

	public static function factory(string $type, string $name): static {
		$definition = $type::setup($name);
		$props      = $definition['props'] ?? [];
		$parameters = [];

		foreach ($props as $attr => $prop) {
			if ($attr === 'value') {
				continue;
			}

			if (is_callable($prop) === false) {
				continue;
			}

			$reflectable = new ReflectableFunction($prop);
			$parameter   = $reflectable->parameters()->toArray()[0] ?? null;

			if ($parameter !== null) {
				$types = $parameter->types();
				$types->remove('null');
				$parameters[$attr] = new Parameter(
					name:        $attr,
					types:       $types,
					default:     $parameter->default(),
					description: $reflectable->summary(),
					isRequired:  $parameter->isRequired()
				);
			}
		}

		ksort($parameters);

		return new static(
			type: $type,
			name: $name,
			parameters: new Parameters($parameters)
		);
	}

	public function parameters(): Parameters
	{
		return $this->parameters;
	}
}
