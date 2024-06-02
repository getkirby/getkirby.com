<?php

class ReleaseGuidePage extends DefaultPage
{
	public function menuUrl(): string
	{
		return $this->link()->toUrl() ?? $this->url();
	}

	public function release()
	{
		return $this->parents()->not('releases')->last();
	}
}
