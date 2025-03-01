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
		$current  = $this->site()->page();
		$featured = [
			...page('docs/reference/objects')->menu()->yaml(),
			...page('docs/reference/tools')->menu()->yaml()
		];

		foreach ($featured as $id) {
			if (Str::contains($current->id(), $id) === true) {
				return false;
			}
		}

		return parent::isOpen();
	}
}
