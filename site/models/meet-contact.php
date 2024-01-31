<?php

use Kirby\Cms\Page;

class MeetContactPage extends Page
{
	public function hasPlatforms(): bool
	{
		return
			$this->discord()->isNotEmpty() ||
			$this->email()->isNotEmpty() ||
			$this->forum()->isNotEmpty() ||
			$this->github()->isNotEmpty() ||
			$this->instagram()->isNotEmpty() ||
			$this->linkedin()->isNotEmpty() ||
			$this->mastodon()->isNotEmpty() ||
			$this->website()->isNotEmpty();
	}
}
