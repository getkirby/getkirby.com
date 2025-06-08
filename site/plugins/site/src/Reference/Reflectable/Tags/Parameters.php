<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Toolkit\A;

class Parameters
{
	/**
	 * @param array<Parameter> $parameters
	 */
	public function __construct(
		public array $parameters
	) {
	}

	public function count(): int
	{
		return count($this->parameters);
	}

	public static function factory(
		ReflectableFunction $reflectable,
	): static {
		$parameters = [];

		// Collect all native parameters
		foreach ($reflectable->reflection->getParameters() as $parameter) {
			$name              = $parameter->getName();
			$parameters[$name] = Parameter::factory(
				parameter: $parameter,
				doc:       $reflectable->doc()->getParamNode($name),
				context:   $reflectable
			);
		}

		// Collect all parameters from the doc block and add them
		// if they haven't been added as native parameters yet
		foreach ($reflectable->doc()->getParamTagValues() as $doc) {
			$name                = ltrim($doc?->parameterName, '$');
			$parameters[$name] ??= Parameter::factory(
				doc:     $doc,
				context: $reflectable
			);
		}

		// Remove the `args` parameter if
		// parameters have been documented in the doc block
		if (count($parameters) > 1) {
			unset($parameters['args']);
		}

		return new static(array_values($parameters));
	}

	/**
	 * Returns whether any parameter has a description
	 */
	public function hasDescriptions(): bool
	{
		return count(A::filter(
			$this->parameters,
			fn ($parameter) => $parameter->hasDescription()
		)) > 0;
	}

	/**
	 * Returns a new instance with the parameter filtered by name
	 */
	public function not(string $name): static
	{
		return new static(
			parameters: A::filter(
				$this->parameters,
				fn ($parameter) => $parameter->name !== $name
			)
		);
	}

	public function toArray(): array
	{
		return $this->parameters;
	}

	/**
	 * Returns the string representation of all parameters
	 */
	public function toString(): string
	{
		return implode(
			', ',
			A::map($this->parameters, fn ($parameter) => $parameter->toString())
		);
	}
}
