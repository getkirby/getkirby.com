<?php

use Kirby\Cms\Page;

class LegacyPage extends Page
{
	public function menuUrl(): string
	{
		return $this->src()->value();
	}
}
