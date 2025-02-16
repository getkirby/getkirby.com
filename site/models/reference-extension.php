<?php

use Kirby\Reference\ReferencePage;

class ReferenceExtensionPage extends ReferencePage
{
	public function metadata(): array
	{
		return [
			...parent::metadata(),
			'thumbnail' => [
				'lead'  => 'Reference / Extension',
				'title' => $this->title()
			]
		];
	}
}
