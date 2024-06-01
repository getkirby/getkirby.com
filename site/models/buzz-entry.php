<?php

use Kirby\Cms\Page;
use Kirby\Content\Field;
use Kirby\Toolkit\Str;

class BuzzEntryPage extends Page
{
	public function blurb(): Field
	{
		return $this->intro()->or($this->text());
	}

	public function isExternalLink(): bool
	{
		return
			($url = $this->link()->toUrl()) &&
			Str::startsWith($url, $this->site()->url()) === false;
	}

	public function menuUrl(): string
	{
		return $this->url();
	}

	public function url($options = null): string
	{
		if ($this->link()->isNotEmpty() === true) {
			return $this->link()->value();
		}

		return parent::url($options);
	}

	public function video(): Field
	{
		if (parent::video()->isNotEmpty() === true) {
			$video = str_replace('www.youtube.com', 'www.youtube-nocookie.com', parent::video());
			return parent::video()->value($video);
		}

		return parent::video();
	}
}
