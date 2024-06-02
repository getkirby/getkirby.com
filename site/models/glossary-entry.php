<?php

class GlossaryEntryPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->toUrl() ?? $this->url();
	}
}
