<?php

use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Cms\Files;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;

class PartnerPage extends Page
{
	public function avatar(): File|null
	{
		return $this->images()->findBy('name', 'avatar');
	}

	public function card(): File|null
	{
		return $this->images()->findBy('name', 'card');
	}

	public function isPlusPartner(): bool
	{
		return Str::endsWith($this->package(), '+');
	}

	public function isSoloPartner(): bool
	{
		return Str::startsWith($this->package(), 'solo');
	}

	public function i(): Field
	{
		return parent::i()->value($this->isSoloPartner() ? 'i' : 'we');
	}

	public function me(): Field
	{
		return parent::me()->value($this->isSoloPartner() ? 'me' : 'us');
	}

	public function my(): Field
	{
		return parent::my()->value($this->isSoloPartner() ? 'my' : 'our');
	}
}
