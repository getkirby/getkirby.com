<?php

namespace Kirby\Reference;

use Kirby\Cms\Page;
use Kirby\Cms\Template;

abstract class SectionPage extends ReflectionPage
{

	/**
	 * Flag that this page should not show
	 * the secondary entries sidebar
	 *
	 * @return bool
	 */
	public function hasEntries(): bool
	{
		return false;
	}

	/**
	 * If a dedicated template exist, use it.
	 * Otherwise fall back to `reference-section` template.
	 *
	 * @return \Kirby\Cms\Template
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
