<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Reflectable\Tags\Since;
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
	 * @var ReflectionMethod
	 */
	public Reflector $reflection;

	public function __construct(
		public string $class,
		public string $method,
		public string|null $classalias = null
	) {
		$this->reflection = new ReflectionMethod($class, $method);
	}

	/**
	 * Returns the names of the methods that are aliases
	 * for this method
	 */
	public function aliases(): array
	{
		$aliases    = [];
		$reflection = new ReflectionClass($this->class);

		foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			$alias = new ReflectableClassMethod($this->class, $method->getName());

			if (
				$alias->isMagic() === false &&
				$alias->see()?->for() === $this->method
			) {
				$aliases[] = $alias->method;
			}
		}

		return $aliases;
	}

	/**
	 * Returns the name of the method's class
	 */
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

	/**
	 * Returns the class where the method is defined
	 */
	public function inheritedFrom(): Identifier|null
	{
		$origin = $this->reflection->getDeclaringClass()->getName();

		if ($origin === $this->class()) {
			return null;
		}

		return new Identifier($origin);
	}

	/**
	 * Returns whether the method is an alias
	 * for another method of the same class
	 */
	public function isAlias(): bool
	{
		return $this->see()?->for() !== null;
	}

	/**
	 * Returns whether the method or parent class is deprecated
	 */
	public function isDeprecated(): bool
	{
		return
			parent::isDeprecated() ||
			(new ReflectableClass($this->class))->isDeprecated();
	}

	/**
	 * Returns whether the method or parent class has been marked as internal
	 */
	public function isInternal(): bool
	{
		return
			parent::isInternal() ||
			(new ReflectableClass($this->class))->isInternal();
	}

	/**
	 * Returns whether the method is a magic method
	 */
	public function isMagic(): bool
	{
		return substr($this->method, 0, 2) === '__';
	}

	/**
	 * Returns whether the method or parent class has been marked as unstable
	 */
	public function isUnstable(): bool
	{
		return
			parent::isUnstable() ||
			(new ReflectableClass($this->class))->isUnstable();
	}

	public function mutationDescription(): string|null
	{
		$returns = $this->returns();

		if ($this->isStatic() === true || $returns?->isVoid() === true) {
			return null;
		}

		$object = '$' . strtolower($this->class(true));

		if ($returns->isImmutable() === true) {
			return 'This method does not modify the existing `' . $object . '` object but returns a new object with the changes applied. (link: docs/guide/templates/php-api#immutable-objects text: Learn more →)';
		}

		return 'This method modifies the existing `' . $object . '` object it is applied to and returns it again.';
	}

	/**
	 * Returns the name of the method incl. the class name
	 */
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

	/**
	 * Returns the `@since` tag, if present
	 * taking into account the parent class
	 */
	public function since(): Since|null
	{
		return parent::since() ?? Since::factory(
			reflection: new ReflectableClass($this->class)
		);
	}

	/**
	 * Returns the path to the source code of the method
	 */
	protected function sourcePath(): string|null
	{
		$file = $this->reflection->getFileName();

		if ($file === false) {
			return null;
		}

		$path = Str::from($file, 'src/');
		return $path;
	}
}
