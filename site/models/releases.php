<?php

use Kirby\Cms\App;
use Kirby\Github\Github;
use Kirby\Toolkit\Str;

class ReleasesPage extends DefaultPage
{
	/**
	 * Returns all tags in the `getkirby/kirby` GitHub repo
	 */
	public static function allTags(): array
	{
		$kirby   = App::instance();
		$cache   = $kirby->cache('github');
		$entry   = $cache->get('releases');
		$version = $kirby->version();

		if (
			$entry !== null &&
			$entry['currentVersion'] === $version
		) {
			return $entry['releases'];
		}

		try {
			$releases = [];
			$response = Github::request('getkirby/kirby', 'git/refs/tags');

			foreach ($response->json() as $release) {
				$releases[] = Str::after($release['ref'], 'refs/tags/');
			}

		} catch (InvalidArgumentException) {
			// no GitHub API key is available
			return [];
		}

		$cache->set(
			'releases',
			[
				'currentVersion' => $version,
				'releases'       => $releases
			],
			10080
		);

		return $releases;
	}
}
