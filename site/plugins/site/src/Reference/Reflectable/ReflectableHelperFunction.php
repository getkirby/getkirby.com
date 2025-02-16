<?php

namespace Kirby\Reference\Reflectable;

use Exception;

class ReflectableHelperFunction extends ReflectableFunction
{
	public function __construct(
		public string $name
	) {
		if (function_exists($name) === false) {
			throw new Exception('Helper function "' . $name . '" not found');
		}

		parent::__construct($name);
	}

	public function call(): string
	{
		return 'V::' . parent::call();
	}

	protected function sourcePath(): string
	{
		return 'src/Toolkit/V.php';
	}
}
