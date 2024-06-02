<?php

require_once __DIR__ . '/default.php';

class GuidesPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return collection('guides')->first()->menuUrl();
	}
}
