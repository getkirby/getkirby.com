<?php

use Kirby\Content\Field;

class ReferenceEndpointsPage extends ReferenceSectionPage
{
	public function intro(): Field
	{
		return parent::intro()->value('/api/' . $this->slug());
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'description' => 'Documentation for ' . $this->title() . ' API endpoints.',
			'thumbnail' => [
				'lead'  => 'Reference / API'
			]
		]);
	}

	/**
	 * Default minimum width for section grid items
	 */
	public function sectionGridMinWidth(): string
	{
		return '28rem';
	}
}
