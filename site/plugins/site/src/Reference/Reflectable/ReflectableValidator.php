<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Toolkit\V;

/**
 * Reflectable for a validator
 */
class ReflectableValidator extends ReflectableClassMethod
{
	public function __construct(
		public string $name
	) {
		if (method_exists(V::class, $this->name) === false) {
			throw new Exception('Validator "' . $this->name . '" not found');
		}

		parent::__construct(V::class, $this->name);
	}
}
