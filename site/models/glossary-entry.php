<?php

require_once __DIR__ . '/default.php';

class GlossaryEntryPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->toUrl() ?? $this->url();
	}
}
