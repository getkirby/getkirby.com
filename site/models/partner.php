<?php

use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Http\Remote;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

class PartnerPage extends DefaultPage
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
		$id       = $this->plugindeveloper()->or($this->slug());
		$url      = 'https://plugins.getkirby.com/' . $id;
		$response = Remote::get($url . '.json');

		if ($response->code() !== 200) {
			return null;
		}

		$json      = $response->json();
		$developer = new Page([
			'slug'    => $id,
			'url'     => $url,
			'content' => [
				'title' => $json['name']
			]
		]);

		if (parent::plugins()->isNotEmpty() === true) {
			$plugins = A::map(
				parent::plugins()->yaml(),
				fn ($plugin) => $json['plugins']['developers/' . $id . '/' . $plugin] ?? null
			);
			$plugins = array_filter($plugins);
		}

		$plugins ??= A::slice($json['plugins'] ?? [], 0, 5);
		$plugins   = A::map(
			array_keys($plugins),
			fn ($plugin) => new Page([
				'slug'    => $plugin,
				'parent'  => $developer,
				'url'     => $plugins[$plugin]['url'],
				'content' => [
					'title'       => $plugins[$plugin]['title'],
					'description' => $plugins[$plugin]['description'],
					'example'     => $plugins[$plugin]['example'] ?? null
				],
				'files' => isset($plugins[$plugin]['card']) ? [
					[
						'filename' => basename($plugins[$plugin]['card']),
						'url'      => $plugins[$plugin]['card']
					]
				] : []
			])
		);

		return new Pages($plugins);
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
