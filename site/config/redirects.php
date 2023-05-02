<?php

return [
	// Quicklinks
	'v3'                              => 'releases/3.0',
	'v35'                             => 'releases/3.5',
	'releases.rss'                    => 'https://github.com/getkirby/kirby/releases.atom',

	// 2021 - Legacy
	'resources'                       => 'kosmos',
	'community'                       => 'https://chat.getkirby.com',
	'community/(:all?)'               => 'https://chat.getkirby.com',
	'reference'                       => 'docs/reference',
	'reference/(:all)'                => 'docs/reference/$1',
	'product'                         => 'features/developers',
	'why'                             => 'features/developers',

	// 2021 - refactored objects in reference
	'docs/reference/@'                => 'docs/reference/objects',
	'docs/reference/@/aliases'        => 'docs/reference/objects/aliases',
	'docs/reference/@/classes'        => 'docs/reference/objects',
	'docs/reference/@/classes/(:all)' => 'docs/reference/objects/$1',

	'docs/reference/objects/(:any)/(:all)' => function ($class, $method) {
		if ($class === 'kirby') {
			$class = 'cms/app';
		} else if ($class === 'request') {
			$class = 'http/request';
		} else if ($class === 'session') {
			$class = 'session/session-data';
		} else  {
			$class = 'cms/' . $class;
		}

		if ($page = page('docs/reference/objects/' . $class . '/' . $method)) {
			return $page->url();
		}

		return 'error';
	},

	'docs/reference/tools/(:any)/(:all)' => function ($class, $method) {
		// get the `reference-quicklink` page
		if ($page = page('docs/reference/tools/' . $class)) {
			// follow to target page (in `reference/objects/`)
			if ($target = $page->link()->toPage()) {
				// get the child page requested
				if ($target = $target->find($method)) {
					return $target->id();
				}
			}
		}
		return 'error';
	},


	// 2019 - Legacy
	'blog/kosmos-(:any)'              => 'kosmos/$1',
	'docs/cheatsheet'                 => 'docs/reference',
	'docs/cheatsheet/(:all?)'         => 'docs/reference/$1',
	'docs/toolkit'                    => 'docs/reference',
	'docs/toolkit/(:all?)'            => 'docs/reference/$1',
	'made-with-kirby-and-love'        => 'love',
	'docs/guide/installation'         => 'docs/guide/quickstart',
	'docs/guide/blueprints/tabs'      => 'docs/guide/blueprints/layout#tabs',
	'docs/cookbook/migration/sites'   => 'docs/cookbook/setup/migrate-site',
	'docs/cookbook/migration/files'   => 'docs/cookbook/setup/migrate-files',
	'docs/cookbook/migration/users'   => 'docs/cookbook/setup/migrate-users',
	'docs/cookbook/migration/plugins' => 'docs/cookbook/setup/migrate-plugins',


	// Fuyyz finder
	'docs/reference/(:any)/(:all?)' => function ($group, $path = null) {
		$pages = page('docs/reference')->grandChildren()->listed();
		if ($page = $pages->findBy('uid', $group)) {
			return $page->id() . '/'. $path;
		}

		return 'error';
	},
	'docs/cookbook/(:any)/(:all)'     => function ($category, $uid) {
		$pages = page('docs/cookbook')->grandChildren()->listed();
		if ($page = $pages->findBy('uid', $uid)) {
			return $page->url();
		}

		return 'error';
	}
];
