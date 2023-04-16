<?php

namespace Kirby\Reference;

use Kirby\Cms\Pages;
use Kirby\Template\Template;

abstract class SectionPage extends ReflectionPage
{
	public function children(): Pages
	{
		return parent::children()->filterBy('isInternal', false);
	}

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
		$template = parent::template();

		// If template exists, use it
		if ($this->intendedTemplate() === $template) {
			return $template;
		}

		return $this->kirby()->template('reference-section');
	}
}
