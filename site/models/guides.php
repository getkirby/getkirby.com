<?php

class GuidesPage extends DefaultPage
{
	public function menuUrl(): string
	{
		return collection('guides')->first()->menuUrl();
	}
}
