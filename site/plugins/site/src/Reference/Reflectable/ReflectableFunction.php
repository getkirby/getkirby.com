<?php

namespace Kirby\Reference\Reflectable;

use Closure;
use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Reflectable\Tags\Returns;
use ReflectionFunction;
use ReflectionMethod;
use Reflector;

/**
 * Reflectable abstract for functions
 */
class ReflectableFunction extends Reflectable
{
	/**
	 * @var \ReflectionMethod
	 */
	public Reflector $reflection;

	protected Parameters $parameters;
	protected Returns|null $returns;

	public function __construct(
		public string|Closure $function
	) {
		$this->reflection = new ReflectionFunction($function);
	}

	/**
	 * Returns the string representation of the function call
	 * incl. all parameters and return type
	 */
	public function call(): string
	{
		$parameters = $this->parameters()->toString();
		$call       = $this->name() . '(' . $parameters . ')';

		if ($returns = $this->returns()) {
			$call .= ': ' . $returns->types()->toString();
		}

		return $call;
	}

	/**
	 * Returns whether the function is static
	 */
	public function isStatic(): bool
	{
		return $this->reflection->isStatic();
	}

	/**
	 * Returns the name of the function
	 */
	public function name(): string
	{
		return $this->reflection->getName();
	}

	/**
	 * Returns the parameters of the function
	 */
	public function parameters(): Parameters
	{
		return $this->parameters ??= Parameters::factory($this);
	}

	/**
	 * Returns the return tag of the function, if present
	 */
	public function returns(): Returns|null
	{
		return $this->returns ??= Returns::factory($this);
	}

	/**
	 * Returns the line number where the function begins in the source code
	 */
	protected function sourceLine(): int|null
	{
		return $this->reflection->getStartLine();
	}
}
