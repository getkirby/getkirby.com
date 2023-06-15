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

	public function country(): Field
	{
		$location = $this->location()->value();

		if ($position = mb_strrpos($location, ',')) {
			return parent::country()->value(trim(Str::substr($location, $position + 1)));
		}

		return parent::country()->value($location);
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

	public function languages(bool $formatted = false): Field
	{
		$languages = parent::languages();

		if ($formatted === false) {
			return $languages;
		}

		$languagesString = $languages->value();

		if ($lastComma = mb_strrpos($languagesString, ',')) {
			$languagesString = mb_substr($languagesString, 0, $lastComma) . ' &' . mb_substr($languagesString, $lastComma + 1);
		}

		return $languages->value($languagesString);
	}

	public function me(): Field
	{
		return parent::me()->value($this->isSoloPartner() ? 'me' : 'us');
	}

	public function metadata(): array
	{
		return [
			'ogimage' => $this->card()
		];
	}

	public function my(): Field
	{
		return parent::my()->value($this->isSoloPartner() ? 'my' : 'our');
	}

	public function plugins(): Pages|null
	{
		if (parent::plugins()->isNotEmpty() === true)
		{
			$plugins = parent::plugins()->toPages();

            return $plugins->isNotEmpty() ? $plugins : null;
		}

		return $this->pluginpage()->toPage()?->children()->limit(6);
	}

	public function type(): Field
	{
		return parent::type()->value($this->isSoloPartner() ? 'solo' : 'team');
	}

	public function typeLabel(): Field
	{
		return parent::typeLabel()->value(ucfirst($this->type()));
	}
}
