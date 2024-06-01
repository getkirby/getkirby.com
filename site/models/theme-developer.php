<?php

use Kirby\Cms\Page;

class ThemeDeveloperPage extends Page
{
	public function menuUrl(): string
	{
		return $this->parent()->url();
	}
}
