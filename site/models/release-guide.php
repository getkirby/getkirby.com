<?php

require_once __DIR__ . '/default.php';

class ReleaseGuidePage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->or($this->url())->value();
	}

	public function release()
	{
		return $this->parents()->not('releases')->last();
	}
}
