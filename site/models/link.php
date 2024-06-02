<?php

class LinkPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->toUrl();
	}
}
