<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Cms\App;

class ReflectableCoreComponent extends ReflectableFunction
{
	public function __construct(
		public string $name
	) {
		static $components = require App::instance()->root('kirby') . '/config/components.php';

		$component = $components[$name] ?? null;

		if ($component === null) {
			throw new Exception('Core component "' . $name . '" not found');
		}

		parent::__construct($component);
	}

	protected function sourcePath(): string
	{
		return 'config/components.php';
	}
}
