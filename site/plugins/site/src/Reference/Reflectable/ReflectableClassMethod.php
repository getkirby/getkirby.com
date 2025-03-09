<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Reflectable\Tags\Returns;
use Kirby\Reference\Types\Identifier;
use Kirby\Toolkit\Str;
use ReflectionClass;
use ReflectionMethod;
use Reflector;

/**
 * Reflectable for a class method
 */
class ReflectableClassMethod extends ReflectableFunction
{
	/**
	 * @var \ReflectionMethod
	 */
	public Reflector $reflection;

	public function __construct(
		public string $class,
		public string $method,
		public string|null $classalias = null
	) {
		$this->reflection = new ReflectionMethod($class, $method);
	}

	public function class(
		bool $short = false,
		bool $typed = false
	): string|Identifier {
		$class = new ReflectionClass($this->class);
		$class = match ($short) {
			true  => $class->getShortName(),
			false => $class->getName(),
		};

		if ($typed === true) {
			return new Identifier($class);
		}

		return $class;
	}

	public function inheritedFrom(): Identifier|null
	{
		$origin = $this->reflection->getDeclaringClass()->getName();

		if ($origin === $this->class()) {
			return null;
		}

		return new Identifier($origin);
	}

	public function isMagic(): bool
	{
		return substr($this->method, 0, 2) === '__';
	}

	public function name(): string
	{
		$class = $this->classalias ?? $this->class(true);

		if ($this->method === '__construct') {
			return 'new ' . $class;
		}

		if ($this->isStatic() === true) {
			return $class . '::' . $this->method;
		}

		return '$' . Str::camel($class) . '->' . $this->method;
	}

	public function parameters(): Parameters
	{
		return $this->parameters ??= Parameters::factory($this);
	}

	public function returns(): Returns|null
	{
		return $this->returns ??= Returns::factory($this);
	}

	/**
	 * Get `@see` tag value which references
	 * another class method to refer to for more information
	 */
	public function see(): string|null
	{
		$see = parent::see();

		if ($see === null) {
			return null;
		}

		// remove self:: or static:: prefix
		$see = preg_replace('/^(self|static)::/', '::', $see);

		// add class name if missing
		if (str_starts_with($see, '::') === true) {
			$see = $this->class(short: false) . $see;
		}

		return $see;
	}

	protected function sourcePath(): string
	{
		$file = $this->reflection->getFileName();
		$path = Str::from($file, 'src/');
		return $path;
	}
}
