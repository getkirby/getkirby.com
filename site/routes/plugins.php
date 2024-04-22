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
		'pattern' => 'plugins.json',
		'action'  => function () use($plugins) {
			return Remote::get($plugins . '/plugins.json')->json();
		}
	],
	[
		'pattern' => 'plugins/(:all).json',
		'action'  => function (string $path) use($plugins) {
			return Remote::get($plugins . '/' . $path . '.json')->json();
		}
	],
	[
		'pattern' => 'plugins/(:all)',
		'action'  => fn ($path) => go($plugins . '/' . $path)
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
