<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Cms\App;

class ReflectableKirbytag extends ReflectableFunction
{
	protected array $attributes;

	public function __construct(
		public string $name
	) {
		$tag = App::instance()->core()->kirbyTags()[$name] ?? null;

		if ($tag === null) {
			throw new Exception('Kirbytag "' . $name . '" not found');
		}

		$this->attributes = $tag['attr'];
		parent::__construct($tag['html']);
	}

	public function call(): string
	{
		return 'V::' . parent::call();
	}

	protected function sourceLine(): int|null
	{
		$line = $this->reflection->getStartLine();
		$line -= 2;

		if (count($this->attributes) > 0) {
			$line -= count($this->attributes) + 1;
		}

		return $line;
	}

	protected function sourcePath(): string
	{
		return 'config/tags.php';
	}
}
