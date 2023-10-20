<?php

use Kirby\Cms\Page;
use Kirby\Template\Template;

class ReleasePage extends Page
{
	public function template(): Template
	{
		return $this->template ??= $this->kirby()->template('release-' . $this->content()->version());
	}

	public function url($options = null): string
	{
		return $this->parent()->url() . '/' . str_replace('-', '.', $this->slug());
	}
}
