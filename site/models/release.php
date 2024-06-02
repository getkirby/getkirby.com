<?php

use Kirby\Template\Template;

class ReleasePage extends DefaultPage
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
