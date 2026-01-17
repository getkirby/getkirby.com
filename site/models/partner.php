<?php

use Kirby\Cms\File;
use Kirby\Cms\Files;
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

	public function country(): Field
	{
		$location = $this->location()->value();

		if ($position = mb_strrpos($location, ',')) {
			return parent::country()->value(
				trim(Str::substr($location, $position + 1))
			);
		}

		return parent::country()->value($location);
	}

	public function isCertified(): bool
	{
		return $this->plan()->value() === 'certified';
	}

	public function i(): Field
	{
		return parent::i()->value($this->isSoloPartner() ? 'i' : 'we');
	}

	public function isSoloPartner(): bool
	{
		return $this->people()->value() === '1';
	}

	public function languages(bool $formatted = false): Field
	{
		$languages = parent::languages();

		if ($formatted === false) {
			return $languages;
		}

		$string = $languages->value();

		if ($lastComma = mb_strrpos($string, ',')) {
			$string =
				mb_substr($string, 0, $lastComma) . ' &' .
				mb_substr($string, $lastComma + 1);
		}

		return $languages->value($string);
	}

	public function me(): Field
	{
		return parent::me()->value($this->isSoloPartner() ? 'me' : 'us');
	}

	public function metadata(): array
	{
		return [
			'ogimage' => $this->card(),
		];
	}

	public function card(): File|null
	{
		return $this->images()->findBy('name', 'card');
	}

	public function my(): Field
	{
		return parent::my()->value($this->isSoloPartner() ? 'my' : 'our');
	}

	public function peopleLabel(): string
	{
		if ($this->people()->toInt() > 1) {
			return $this->people() . ' people';
		}

		return '1 person';
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
				'title' => $json['name'],
			],
		]);

		if (parent::plugins()->isNotEmpty() === true) {
			$plugins = A::map(
				parent::plugins()->yaml(),
				fn($plugin) => $json['plugins']['developers/' . $id . '/' . $plugin] ?? null
			);
			$plugins = array_filter($plugins);
		}

		$plugins ??= A::slice($json['plugins'] ?? [], 0, 5);
		$plugins = A::map(
			array_keys($plugins),
			fn($plugin) => new Page([
				'slug'    => $plugin,
				'parent'  => $developer,
				'url'     => $plugins[$plugin]['url'],
				'content' => [
					'title'       => $plugins[$plugin]['title'],
					'description' => $plugins[$plugin]['description'],
					'example'     => $plugins[$plugin]['example'] ?? null,
				],
				'files'   => isset($plugins[$plugin]['card']) ? [
					[
						'filename' => basename($plugins[$plugin]['card']),
						'url'      => $plugins[$plugin]['card'],
					],
				] : [],
			])
		);

		return new Pages($plugins);
	}

	public function stripe(): File|null
	{
		return $this->images()->findBy('name', 'stripe') ?? $this->card();
	}

	public function children(): Pages
	{
		if ($this->children instanceof Pages) {
			return $this->children;
		}
		// How can we pass a param to this path depending on request params
		// And make sure that it is not cached?
		$gallery = [];

		$request = Remote::get(option('partners.partnerUrl') .
			$this->slug() . '.json' .
			'?apiToken=' . option('keys.partnerAccessToken')
		);

		if ($request->code() === 200) {
			$gallery = $request->json(true);
		}

		$gallery = A::map(
			$gallery,
			fn($galleryItem) => [
				'slug'     => $slug = Str::slug($galleryItem['title']),
				'parent'   => $this,
				'url'      => $this->url() . '/' . $slug,
				'model'    => 'gallery-item',
				'template' => 'gallery-items',
				'content'  => [
					'title' => $galleryItem['title'],
					'info'  => $galleryItem['info'],
					'link'  => $galleryItem['link']
				],
				'files' => [
					$galleryItem['image']
				]
			]
		);

		return $this->children = Pages::factory($gallery, $this);
	}

	protected function setFiles(array|null $files = null): static
	{
		if (is_array($files)) {
			$this->files = PartnersPage::virtualFileFactory($files, $this);
			return $this;
		}

		return parent::setFiles($files);
	}

	public function getChanges(): self
	{
		$this->setContent($this->changes()->value());
		return $this;
	}
}
