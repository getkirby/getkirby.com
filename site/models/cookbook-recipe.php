<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;

class CookbookRecipePage extends Page
{
	public function authors(): Pages
	{
		return parent::authors()->toPages();
	}

	public function isNew(): bool
	{
		return $this->published()->toDate('U') > (time() - 4500000);
	}

	public function metadata(): array
	{
		return [
			'thumbnail' => [
				'lead'  => 'Kirby Cookbook',
				'title' => $this->title()
			]
		];
	}
}
