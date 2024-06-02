<?php

class ReferenceArticlePage extends DefaultPage
{
	public function metadata(): array
	{
		return [
			'description' => strip_tags($this->intro()->kirbytags()),
			'thumbnail' => [
				'lead'  => $this->metaLead(page('docs/reference'))
			]
		];
	}
}
