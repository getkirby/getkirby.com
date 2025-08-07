<?php

class GlossaryEntryPage extends DefaultPage
{
	public function markdownUrl(): string
	{
		return parent::url() . '.md';
	}

	public function menuUrl(): string
	{
		return $this->link()->toUrl() ?? $this->url();
	}
}
