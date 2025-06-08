<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use ReflectionClass;
use Reflector;

/**
 * Reflectable for a class
 */
class ReflectableClass extends Reflectable
{
	/**
	 * @var \ReflectionClass
	 */
	public Reflector $reflection;

	public function __construct(
		public string $name
	) {
		$this->reflection = new ReflectionClass($name);
	}

	/**
	 * Returns the class alias, if present
	 */
	public function alias(): string|null
	{
		static $aliases = require App::instance()->root('kirby') . '/config/aliases.php';

		$alias = array_search($this->name(), $aliases) ?: null;

		if ($alias === null) {
			return null;
		}

		return ucfirst($alias);
	}

	public function isStatic(): bool
	{
		return $this->reflection->hasMethod('__construct') === false;
	}

	/**
	 * Returns whether the class is a trait
	 */
	public function isTrait(): bool
	{
		return $this->reflection->isTrait();
	}

	/**
	 * Returns all methods of the class
	 */
	public function methods(): array
	{
		return $this->reflection->getMethods();
	}

	/**
	 * Returns the name of the class
	 */
	public function name(bool $short = false): string
	{
		return match ($short) {
			true  => $this->reflection->getShortName(),
			false => $this->reflection->getName()
		};
	}

	/**
	 * Returns the line number where the class begins in the source code
	 */
	protected function sourceLine(): int|false
	{
		return $this->reflection->getStartLine();
	}

	/**
	 * Returns the path to the source code of the class
	 */
	protected function sourcePath(): string
	{
		$path = str_replace('Kirby\\', '', $this->name());
		$path = str_replace('\\', '/', $path);
		return 'src/' . $path . '.php';
	}
}
