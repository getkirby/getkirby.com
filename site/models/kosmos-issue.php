<?php

use Kirby\Cms\Page;

class KosmosIssuePage extends Page
{
	public function metadata(): array
	{
		return [
			'ogtitle'     => 'Kirby Kosmos Episode ' . $this->uid(),
			'description' => 'Read issue no. ' . $this->uid() . ' of our monthly newsletter online.',
			'thumbnail' => [
				'lead'  => 'Kirby Kosmos',
				'title' => 'Episode ' . $this->uid(),
				'image' => $this->image()
			],
			'changefreq' => 'never'
		];
	}
}
