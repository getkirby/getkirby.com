<?php

$plugins = 'https://plugins.getkirby.com';

return [
	[
		'pattern' => 'plugins/create',
		'action'  => function () {
			return page('plugins/create');
		}
	],
	[
		'pattern' => 'plugins/k4',
		'action'  => fn () => go($plugins . '/supports/4')
	],
	[
		'pattern' => 'plugins/new',
		'action'  => fn () => go($plugins . '/new')
	],
	[
		'pattern' => 'plugins.json',
		'action'  => fn () => go($plugins . '/plugins.json')
	],
	[
		'pattern' => 'plugins/(:any)',
		'action'  => fn ($developer) => go($plugins . '/' . $developer)
	],
	[
		'pattern' => 'plugins/(:any)/(:any).json',
		'action'  => fn (string $developer, string $plugin) => go($plugins . '/' . $developer . '/' . $plugin . '.json')
	],
	[
		'pattern' => 'plugins/(:any)/(:any)',
		'action'  => fn (string $developer, string $plugin) => go($plugins . '/' . $developer . '/' . $plugin)
	],
	[
		'pattern' => 'plugins',
		'action'  => function () use ($plugins) {
			$category = param('category');

			if ($category && $category !== 'all') {
				go($plugins . '/topics/' . $category);
			}

			go($plugins);
		}
	],
];
