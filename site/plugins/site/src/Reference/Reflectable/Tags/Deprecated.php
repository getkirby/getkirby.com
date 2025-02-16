<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;

class Deprecated
{
	public function __construct(
		public string|null $version,
		public string|null $description
	) {
	}

	public function description(): string|null
	{
		return $this->description;
	}

	public static function factory(Reflectable $reflectable): static|null
	{
		/**
		 * @var \phpDocumentor\Reflection\DocBlock\Tags\Deprecated|null
		 */
		$tag = $reflectable->doc->getTagsByName('deprecated')[0] ?? null;

		if ($tag === null) {
			return null;
		}

		return new static(
			version:     $tag->getVersion(),
			description: $tag->getDescription()?->getBodyTemplate()
		);
	}

	public function version(): string|null
	{
		return $this->version;
	}
}
