<?php

use Kirby\Cms\Page;

class LinkPage extends Page
{
	public function menuUrl(): string
	{
		return $this->link()->value();
	}
}
