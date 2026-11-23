<?php

use Kirby\Toolkit\Str;

class ReferenceClassOverviewPage extends LinkPage
{
	/**
	 * Ensures that the class overview is not marked as open
	 * when the current page is a/inside a featured class.
	 * This avoids multiple menu items highlighted as current.
	 */
	public function isOpen(): bool
	{
		$current = $this->site()->page()->id();
		$ignore  = [
			...ReferenceClassesPage::featured(),
			'docs/reference/objects/aliases'
		];

		foreach ($ignore as $id) {
			if (Str::contains($current, $id) === true) {
				return false;
			}
		}

		return parent::isOpen();
	}
}
