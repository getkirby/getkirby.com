<?php

use Kirby\Cms\Page;

class GuidePage extends Page
{
	public function isChapter(): bool
	{
		return $this->text()->isEmpty() && $this->hasChildren();
	}

	public function menuUrl(): string
	{
		if ($this->isChapter()) {
			return $this->children()->first()->url();
		}

		return parent::url();
	}

	public function metadata(): array
	{
		return [
			'description' => strip_tags($this->intro()->kirbytags()),
			'thumbnail' => [
				'lead' => $this->metaLead(page('docs/guide'), 'Guide'),
			]
		];
	}
}
