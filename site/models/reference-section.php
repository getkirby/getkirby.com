<?php

use Kirby\Template\Template;

class ReferenceSectionPage extends ReferenceArticlePage
{
	/**
	 * Page should not show secondary entries sidebar
	 */
	public function hasEntries(): bool
	{
		return false;
	}

	/**
	 * If a dedicated template exist, use it.
	 * Otherwise fall back to `reference-section` template.
	 */
	public function template(): Template
	{
		// If template exists, use it
		if ($this->intendedTemplate() === parent::template()) {
			return parent::template();
		}

		return $this->kirby()->template('reference-section');
	}
}
