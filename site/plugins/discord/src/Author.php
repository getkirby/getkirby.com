<?php

namespace Kirby\Discord;

/**
 * Author information for a Discord webhook request
 *
 * @author Kirby Team <mail@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Author
{
	public function __construct(
		public string $name,
		public string|null $url,
		public string|null $icon
	) {
	}

	public static function from(self|array|null $author): static|null
	{
		return match (true) {
			$author === null
				=> null,
			is_array($author)
				=> new static(...$author),
			default
				=> $author
		};
	}

	public function toArray(): array
	{
		return [
			'name'      => $this->name,
			'url'       => $this->url,
			'icon_url'  => $this->icon
		];
	}
}
