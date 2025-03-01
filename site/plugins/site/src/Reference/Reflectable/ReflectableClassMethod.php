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

	public function name(string|null $class = null): string
	{
		$class ??= $this->class(true);

		if ($this->method === '__construct') {
			return 'new ' . $class;
		}

		if ($this->isStatic() === true) {
			return $class . '::' . $this->method;
		}

		return '$' . strtolower($class) . '->' . $this->method;
	}

	protected function sourcePath(): string
	{
		$file = $this->reflection->getFileName();
		$path = Str::from($file, 'src/');
		return $path;
	}
}
