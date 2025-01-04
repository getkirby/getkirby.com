<?php

use Kirby\Github\Github;
use Kirby\Template\Template;
use Kirby\Toolkit\Str;

class ReleasePage extends DefaultPage
{
	/**
	 * Returns all tags in the `getkirby/kirby` GitHub repo
	 */
	protected function allReleases(): array
	{
		$kirby = $this->kirby();
		$cache = $kirby->cache('github');

		$entry = $cache->get('releases');
		if (
			$entry !== null &&
			$entry['currentVersion'] === $kirby->version()
		) {
			return $entry['releases'];
		}

		$releases = [];
		foreach (Github::request('getkirby/kirby', 'git/refs/tags')->json() as $release) {
			$releases[] = Str::after($release['ref'], 'refs/tags/');
		}

		$cache->set('releases', ['currentVersion' => $kirby->version(), 'releases' => $releases], 10080);

		return $releases;
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
		return array_filter(
			$this->allReleases(),
			function ($release) use ($stable) {
				// filter by the current version
				if (Str::startsWith($release, $this->version() . '.') === false) {
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
		return array_filter(
			$this->releases($stable),
			function ($release) {
				// filter out the .0 version and its previews
				if (
					$release === $this->version()->value() . '.0' ||
					$release === $this->version()->value() . '.0.0' ||
					Str::startsWith($release, $this->version() . '.0-') === true ||
					Str::startsWith($release, $this->version() . '.0.0-') === true
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
		$template ??= 'release-' . $this->content()->version();

		return $this->template ??= $this->kirby()->template($template);
	}

	public function url($options = null): string
	{
		return $this->parent()->url() . '/' . str_replace('-', '.', $this->slug());
	}
}
