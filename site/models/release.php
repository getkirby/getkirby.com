<?php

use Kirby\Template\Template;

class ReleasePage extends DefaultPage
{
	public function template(): Template
	{
		$template   = $this->content()->get('template')->value();
		$template ??= 'release-' . $this->content()->version();

		return $this->template ??= $this->kirby()->template($template);
	}

	public function url($options = null): string
	{
		return $this->parent()->url() . '/' . str_replace('-', '.', $this->slug());
	}
}
