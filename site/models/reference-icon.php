<?php

use Kirby\Reference\ReflectionPage;

class ReferenceIconPage extends ReflectionPage
{
	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'ogtitle'     => $this->slug() . ' icon',
			'description' => 'Preview of the ”' . $this->slug() . '“ icon.',
			'thumbnail' => [
				'lead'  => 'Reference / Icon',
				'title' => $this->slug()
			]
		]);
	}
}
