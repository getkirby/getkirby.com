<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Reference\Types\Identifier;
use Kirby\Toolkit\Str;
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

	/**
	 * Names of the alias methods per class,
	 * keyed by the method they point to
	 */
	protected static array $aliases = [];

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
		if (isset(static::$aliases[$this->class]) === false) {
			static::$aliases[$this->class] = [];
			$class   = ReflectableClass::for($this->class)->reflection;
			$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

			foreach ($methods as $method) {
				$alias = new ReflectableClassMethod($this->class, $method->getName());

				if (
					$alias->isMagic() === false &&
					($for = $alias->see()?->for()) !== null
				) {
					static::$aliases[$this->class][$for][] = $alias->method;
				}
			}
		}

		return static::$aliases[$this->class][$this->method] ?? [];
	}

	/**
	 * Returns the name of the method's class
	 */
	public function class(
		bool $short = false,
		bool $typed = false
	): string|Identifier {
		$class = ReflectableClass::for($this->class)->name(short: $short);

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
			ReflectableClass::for($this->class)->isDeprecated();
	}

	/**
	 * Returns whether the method or parent class has been marked as internal
	 */
	public function isInternal(): bool
	{
		return
			parent::isInternal() ||
			ReflectableClass::for($this->class)->isInternal();
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
			ReflectableClass::for($this->class)->isUnstable();
	}

	public function mutationDescription(): string|null
	{
		$returns = $this->returns();

		if ($this->isStatic() === true || $returns === null) {
			return null;
		}

		$object = '`$' . strtolower($this->class(true)) . '`';

		return match (true) {
			$returns->isImmutable() => 'This method does not modify the existing ' . $object . ' object but returns a new object with the changes applied. (link: docs/guide/templates/php-api#immutable-objects text: Learn more →)',
			$returns->isMutable()   => 'This method modifies the existing ' . $object . ' object it is applied to and returns it again.',
			default                 => null
		};
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
			reflection: ReflectableClass::for($this->class)
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
