<?php

namespace Kirby\Reference\Reflectable;

use Exception;

/**
 * Reflectable for a helper function
 */
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

	protected function sourcePath(): string
	{
		return 'config/helpers.php';
	}
}
