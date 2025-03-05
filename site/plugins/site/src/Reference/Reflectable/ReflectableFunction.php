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

	public function call(): string
	{
		$parameters = $this->parameters()->toString();
		$call       = $this->name() . '(' . $parameters . ')';

		if ($return = $this->returns()) {
			$call .= ': ' . $return->toString();
		}

		return $call;
	}

	public function isStatic(): bool
	{
		return $this->reflection->isStatic();
	}

	public function name(): string
	{
		return $this->reflection->getName();
	}

	public function parameters(): Parameters
	{
		return $this->parameters ??= Parameters::factory($this);
	}

	public function returns(): Returns|null
	{
		return $this->returns ??= Returns::factory($this);
	}

	protected function sourceLine(): int|null
	{
		return $this->reflection->getStartLine();
	}
}
