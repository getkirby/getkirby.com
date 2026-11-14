<?php

use Kirby\Cms\Page;

class TermsPage extends DefaultPage
{
	public function latestVersion(): Page|null
	{
		$latest = $this->children()->last();

		// terms is the template both for the parent and each version,
		// so only use the child if `$this` is the parent
		if ($latest?->intendedTemplate()->name() === 'terms') {
			return $latest;
		}

		return null;
	}

	public function menuUrl(): string
	{
		return $this->latestVersion()?->url() ?? $this->url();
	}

	public function metadata(): array
	{
		// only versions, which are named by date
		if ($this->parent()?->intendedTemplate()->name() !== 'terms') {
			return [];
		}

		return [
			'thumbnail' => [
				'lead' => 'License / ' . date('F j, Y', strtotime($this->slug()))
			]
		];
	}
}
