<?php

use Kirby\Content\Field;

class ReferenceEndpointPage extends ReferenceArticlePage
{
	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'description' => 'Documentation for the ' . $this->title() . 'API endpoint.',
			'thumbnail' => [
				'lead'  => 'Reference / API'
			]
		]);
	}

	public function request(): string
	{
		return $this->info() . ': ' . $this->title();
	}

	public function title(): Field
	{
		return parent::title()->value(
			'<code>' . $this->info() . '</code> /api' . parent::title()
		);
	}
}
