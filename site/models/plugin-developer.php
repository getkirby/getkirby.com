<?php

use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Content\Field;

/**
 * TODO: Remove when plugin content is no longer in the repo
 */
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

	public function url($options = null): string
	{
		return 'https://plugins.getkirby.com/' . $this->slug();
	}
}
