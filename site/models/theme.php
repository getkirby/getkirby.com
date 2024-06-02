<?php

require_once __DIR__ . '/default.php';

class ThemePage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->value();
	}

	public function prio()
	{
		return parent::prio()->or(9999);
	}
}
