<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Toolkit\V;

/**
 * Reflectable for a validator
 */
class ReflectableValidator extends ReflectableFunction
{
	public function __construct(
		public string $name
	) {
		$validator = V::$validators[$name] ?? null;

		if ($validator === null) {
			throw new Exception('Validator "' . $name . '" not found');
		}

		parent::__construct($validator);
	}

	public function call(): string
	{
		return 'V::' . parent::call();
	}

	public function name(): string
	{
		return $this->name;
	}

	protected function sourcePath(): string
	{
		return 'src/Toolkit/V.php';
	}
}
