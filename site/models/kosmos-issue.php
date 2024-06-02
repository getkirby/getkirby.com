<?php

require_once __DIR__ . '/default.php';

class KosmosIssuePage extends DefaultPage
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
