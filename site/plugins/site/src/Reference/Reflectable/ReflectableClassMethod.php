<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Types\Identifier;
use Kirby\Toolkit\Str;
use ReflectionClass;
use ReflectionMethod;
use Reflector;

class ReflectableClassMethod extends ReflectableFunction
{
	/**
	 * @var \ReflectionMethod
	 */
	public Reflector $reflection;

	public function __construct(
		public string $class,
		public string $method
	) {
		$this->reflection = new ReflectionMethod($class, $method);
		$this->setDoc();
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
		if ($this->method === '__construct') {
			return 'new ' . $this->class(true);
		}

		if ($this->isStatic() === true) {
			return $this->class(true) . '::' . $this->method;
		}

		return '$' . strtolower($this->class(true)) . '->' . $this->method;
	}

	protected function sourcePath(): string
	{
		$file = $this->reflection->getFileName();
		$path = Str::from($file, 'src/');
		return $path;
	}
}
