<?php

use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Cms\Page;

class PluginDeveloperPage extends Page
{
	public function avatar(): File|null
	{
		return $this->image('avatar.png');
	}

	public function github(): Field
	{
		return parent::github()->or('https://github.com/' . $this->slug());
	}

	public function githubAvatar(int $size = 400): string
	{
		return $this->github() . '.png?size=' . $size;
	}
}
