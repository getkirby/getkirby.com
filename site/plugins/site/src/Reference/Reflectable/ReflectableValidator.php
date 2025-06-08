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

	/**
	 * Returns the string representation of the validator call
	 */
	public function call(): string
	{
		return 'V::' . parent::call();
	}

	/**
	 * Returns the name of the validator
	 */
	public function name(): string
	{
		return $this->name;
	}

	/**
	 * Returns the path to the source code
	 */
	protected function sourcePath(): string
	{
		return 'src/Toolkit/V.php';
	}
}
