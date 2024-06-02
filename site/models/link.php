<?php

require_once __DIR__ . '/default.php';

class LinkPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->toUrl();
	}
}
