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

		// iterate over all parameters
		foreach ($reflectable->reflection->getParameters() as $parameter) {
			$name         = $parameter->getName();
			$parameters[] = Parameter::factory(
				parameter: $parameter,
				doc:       $reflectable->doc()->getParamNode($name),
				context:   $reflectable
			);
		}

		return new static($parameters);
	}

	public function hasDescriptions(): bool
	{
		return count(A::filter(
			$this->parameters,
			fn ($parameter) => $parameter->hasDescription()
		)) > 0;
	}

	/**
	 * Removes a parameter by name
	 *
	 * @return $this
	 */
	public function not(string $name): static
	{
		$this->parameters = A::filter(
			$this->parameters,
			fn ($parameter) => $parameter->name !== $name
		);

		return $this;
	}

	public function toArray(): array
	{
		return $this->parameters;
	}

	public function toString(): string
	{
		return implode(
			', ',
			A::map($this->parameters, fn ($parameter) => $parameter->toString())
		);
	}
}
