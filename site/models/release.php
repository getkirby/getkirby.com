<?php

use Kirby\Cms\Page;
use Kirby\Template\Template;

class ReleasePage extends Page
{

	public function contentFileName(string|null $languageCode = null): string
	{
		return 'release';
	}

	public function intendedTemplate(): Template
	{
		return $this->intendedTemplate ??= $this->kirby()->template('release-' . $this->content()->version());
	}

	public function url($options = null): string
	{
		return $this->parent()->url() . '/' . str_replace('-', '.', $this->slug());
	}
}
