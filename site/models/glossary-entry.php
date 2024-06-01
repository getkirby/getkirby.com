<?php

use Kirby\Cms\Page;

class GlossaryEntryPage extends Page
{
	public function menuUrl(): string
	{
		return $this->link()->or($this->url())->value();
	}
}
