<?php

use Kirby\Cms\Page;

class GuidesPage extends Page
{
	public function menuUrl(): string
	{
		return collection('guides')->first()->menuUrl();
	}
}
