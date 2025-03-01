<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use ReflectionClass;
use Reflector;

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

	public function alias(): string|null
	{
		static $aliases = require App::instance()->root('kirby') . '/config/aliases.php';
		return array_search($this->name(), $aliases) ?: null;
	}

	public function isStatic(): bool
	{
		return $this->reflection->hasMethod('__construct') === false;
	}

	public function isTrait(): bool
	{
		return $this->reflection->isTrait();
	}

	public function methods(): array
	{
		return $this->reflection->getMethods();
	}

	public function name(bool $short = false): string
	{
		return match ($short) {
			true  => $this->reflection->getShortName(),
			false => $this->reflection->getName()
		};
	}

	protected function sourceLine(): int|false
	{
		return $this->reflection->getStartLine();
	}

	protected function sourcePath(): string
	{
		$path = str_replace('Kirby\\', '', $this->name());
		$path = str_replace('\\', '/', $path);
		return 'src/' . $path . '.php';
	}
}
