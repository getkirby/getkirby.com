<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Cms\App;

/**
 * Reflectable for a Kirbytag
 */
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

	/**
	 * Returns the attributes of the KirbyTag
	 */
	public function attributes(): array
	{
		return $this->attributes;
	}

	/**
	 * Returns the line number where the KirbyTag begins in the source code
	 */
	protected function sourceLine(): int|null
	{
		$line = $this->reflection->getStartLine();

		if ($line === false) {
			return null;
		}

		$line -= 2;

		if (count($this->attributes) > 0) {
			$line -= count($this->attributes) + 1;
		}

		return $line;
	}

	/**
	 * Returns the path to the source code
	 */
	protected function sourcePath(): string|null
	{
		return 'config/tags.php';
	}
}
