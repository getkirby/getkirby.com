<?php

namespace Kirby\Reference;

use Kirby\Cms\Pages;
use Kirby\Template\Template;

abstract class ReferenceSectionPage extends ReferencePage
{
	/**
	 * Flag that this page should not show
	 * the secondary entries sidebar
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
