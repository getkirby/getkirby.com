<?php

require_once __DIR__ . '/default.php';

class ThemeDeveloperPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->parent()->url();
	}
}
