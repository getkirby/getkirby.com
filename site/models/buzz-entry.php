<?php

use Kirby\Cms\File;
use Kirby\Content\Field;
use Kirby\Toolkit\Str;

class BuzzEntryPage extends DefaultPage
{
	public function blurb(): Field
	{
		return $this->intro()->or($this->text());
	}

	public function cover(): File|null
	{
		return $this->images()->findBy('name', 'cover') ?? $this->image();
	}

	public function isExternalLink(): bool
	{
		$url = $this->link()->toUrl();
		return $url && Str::startsWith($url, $this->site()->url()) === false;
	}

	public function metadata(): array
	{
		return [
			'ogimage' => $this->cover()
		];
	}

	public function url($options = null): string
	{
		if ($this->link()->isNotEmpty() === true) {
			return $this->link()->value();
		}

		return parent::url($options);
	}
}
