<?php

use Kirby\Cache\Cache;
use Kirby\Cms\File;
use Kirby\Cms\Nest;
use Kirby\Content\Field;
use Kirby\Data\Data;
use Kirby\Github\Github;
use Kirby\Http\Remote;
use Kirby\Http\Url;
use Kirby\Toolkit\Obj;
use Kirby\Toolkit\Str;

require_once __DIR__ . '/default.php';

/**
 * TODO: Remove when plugin content is no longer in the repo
 */
class PluginPage extends DefaultPage
{
	protected $info = null;
	protected $latestTag = null;

	public function card(): File|null
	{
		return $this->images()->findBy('name', 'card');
	}

	public function logo(): File|null
	{
		return $this->images()->findBy('name', 'logo');
	}

	public function preview(): Field
	{
		return parent::preview()->or($this->example());
	}

	public function screenshot(): File|null
	{
		return $this->images()->findBy('name', 'screenshot') ?? $this->card();
	}
}
