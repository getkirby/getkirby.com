<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Toolkit\Str;

/**
 * Represents a `@deprecated` tag
 */
class Deprecated
{
	public function __construct(
		public string|null $version = null,
		public string|null $description = null
	) {
	}

	/**
	 * Returns the description of the deprecated tag
	 */
	public function description(): string|null
	{
		return $this->description;
	}

	public static function factory(Reflectable $reflectable): static|null
	{
		// get docblock tag
		$deprecated = $reflectable->doc()->getDeprecatedTagValues();

		if (count($deprecated) === 0) {
			return null;
		}

		// split into version and description
		$tag     = $deprecated[array_key_first($deprecated)];
		$tag     = Str::split($tag->description, ' ');
		$version = array_shift($tag);

		if (count($tag) > 0) {
			$description = implode(' ', $tag);
		}

		return new static(
			version:     $version,
			description: $description ?? null
		);
	}

	/**
	 * Returns the version of the deprecated tag
	 */
	public function version(): string|null
	{
		return $this->version;
	}
}
