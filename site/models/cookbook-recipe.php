<?php

use Kirby\Cms\Pages;

require_once __DIR__ . '/default.php';

class CookbookRecipePage extends DefaultPage
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

	public function pattern(): string
	{
		$slug = $this->parent()->slug();
		$path = '/assets/patterns/cookbook/';

		return $path . ($this->kirby()->option('cookbook.categories')[$slug]['pattern'] ?? 'lagoon') . '.jpg';
	}
}
