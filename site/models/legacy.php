<?php

class LegacyPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->src()->value();
	}
}
