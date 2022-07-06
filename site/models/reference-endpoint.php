<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceEndpointPage extends ReflectionPage
{

	public function request()
	{
		return $this->method() . ': ' . $this->title();
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'description' => 'Documentation for the ' . $this->title() . 'API endpoint.',
			'thumbnail' => [
				'lead'  => 'Reference / API'
			]
		]);
	}

	public function title(): Field
	{
		return parent::title()->value('/api' . parent::title());
	}
}
