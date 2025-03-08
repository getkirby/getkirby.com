<?php

class ReferenceIconPage extends ReferenceArticlePage
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
