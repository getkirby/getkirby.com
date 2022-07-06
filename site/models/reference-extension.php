<?php

use Kirby\Reference\ReflectionPage;

class ReferenceExtensionPage extends ReflectionPage
{

  public function metadata(): array
	{
		return array_merge(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Extension',
				'title' => $this->title()
			]
		]);
	}

}
