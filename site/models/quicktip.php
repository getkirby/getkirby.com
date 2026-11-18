<?php

use Kirby\Cms\Pages;

class QuicktipPage extends DefaultPage
{
	public function authors(): Pages
	{
		return parent::authors()->toPages();
	}

	public function isNew(): bool
	{
		// Archived docs are a static snapshot,
		// in which "new" would never expire
		if (isArchived() === true) {
			return false;
		}

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
