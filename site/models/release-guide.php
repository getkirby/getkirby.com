<?php

class ReleaseGuidePage extends ReleaseChangelogPage
{
	public function menuUrl(): string
	{
		return $this->link()->toUrl() ?? $this->url();
	}
}
