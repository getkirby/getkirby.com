<?php

class ReferenceExtensionPage extends ReferenceArticlePage
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
