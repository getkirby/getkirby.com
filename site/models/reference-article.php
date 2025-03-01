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

	/**
	 * Prevents snippets that are based of a reflection
	 * to be displayed on this page
	 */
	public function reflection(): null
	{
		return null;
	}
}
