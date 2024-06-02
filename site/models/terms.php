<?php

use Kirby\Cms\Page;

require_once __DIR__ . '/default.php';

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
		return $this->latestVersion()->url() ?? $this->url();
	}
}
