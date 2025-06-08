<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Cms\App;
use Kirby\Cms\Html;
use Kirby\Reference\Reflectable\Reflectable;

/**
 * Represents a `@since` tag
 */
class Since
{
	public function __construct(
		public string $version
	) {
	}

	public static function factory(Reflectable $reflection): static|null
	{
		$tag = $reflection->doc()->getTagByName('@since');

		if ($tag === null) {
			return null;
		}

		$since   = $tag->value->value;
		$current = App::instance()->version();

		// ignore any versions but the current major version
		if ((int)$since != (int)$current) {
			return null;
		}

		return new static(version: $since);
	}

	/**
	 * Returns the HTML markup for the since tag
	 */
	public function toHtml(string $format = '%s'): string
	{
		return Html::a(
			option('github.url') . '/kirby/releases/tag/' . $this->version,
			sprintf($format, $this->version)
		);
	}

	/**
	 * Returns the version of the since tag
	 */
	public function version(): string
	{
		return $this->version;
	}
}
