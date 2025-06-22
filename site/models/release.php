<?php

use Kirby\Content\Field;
use Kirby\Template\Template;
use Kirby\Toolkit\Str;

class ReleasePage extends DefaultPage
{
	public function changelogBreaking(): Field
	{
		if ($breaking = $this->find('breaking-changes')) {
			return $breaking->text();
		}

		if ($changelog = $this->find('changelog')) {
			return $changelog->breaking();
		}

		return new Field(
			$this,
			'breaking',
			str_replace(
				'(docs: releases/breaking-changes vars: version=' . substr($this->versionField(), 2, 1) . ')',
				'',
				$this->breaking()
			)
		);
	}

	public function changelogDeprecated(): Field
	{
		if ($deprecated = $this->find('deprecated')) {
			return $deprecated->text();
		}

		if ($changelog = $this->find('changelog')) {
			return $changelog->deprecated();
		}

		return $this->deprecated();
	}

	public function docs(): Field
	{
		$link = $this->kirby()->option('versions')[$this->versionField()->value()]['link'] ?? null;

		return parent::docs()->or($link);
	}

	public function isLatestMajor(): bool
	{
		return (int)$this->kirby()->version() === $this->versionField()->toInt();
	}

	public function latestRelease(): string|null
	{
		// first try the latest stable release
		$releases = $this->releases(stable: true);

		if (count($releases) > 0) {
			return end($releases);
		}

		// if there is none, use the latest preview release
		$releases = $this->releases(stable: false);

		if (count($releases) > 0) {
			return end($releases);
		}

		return null;
	}

	public function releases(bool $stable = true): array
	{
		$version = $this->versionField();

		return array_filter(
			ReleasesPage::allTags(),
			function ($release) use ($stable, $version) {
				// filter by the current version
				if (Str::startsWith($release, $version . '.') === false) {
					return false;
				}

				// filter out alphas, betas and RCs
				if ($stable === true && Str::contains($release, '-') === true) {
					return false;
				}

				return true;
			}
		);
	}

	public function subreleases(bool $stable = true): array
	{
		$version = $this->versionField();

		return array_filter(
			$this->releases($stable),
			function ($release) use ($version) {
				// filter out the .0 version and its previews
				if (
					$release === $version . '.0' ||
					$release === $version . '.0.0' ||
					Str::startsWith($release, $version . '.0-') === true ||
					Str::startsWith($release, $version . '.0.0-') === true
				) {
					return false;
				}

				return true;
			}
		);
	}

	public function template(): Template
	{
		$template   = $this->content()->get('template')->value();
		$template ??= 'release-' . $this->versionField();

		return $this->template ??= $this->kirby()->template($template);
	}

	public function tryLink(): Field
	{
		$field = parent::tryLink();

		// never link to downloads of previous major releases
		if ($this->isLatestMajor() === false) {
			return $field;
		}

		$url  = option('github.url') . '/kirby/archive/refs/tags/';
		$url .= $this->latestRelease() . '.zip';
		return $field->or($url);
	}

	public function url($options = null): string
	{
		if ($this->releasePage()->isNotEmpty()) {
			return $this->releasePage()->toUrl();
		}

		$slug = str_replace('-', '.', $this->slug());
		return $this->parent()->url() . '/' . $slug;
	}

	public function versionField(): Field
	{
		return $this->content()->get('version');
	}
}
