<?php

use Kirby\Cms\Page;

class ReleaseGuidePage extends Page
{
	public function release()
	{
		return $this->parents()->not('releases')->last();
	}
}
