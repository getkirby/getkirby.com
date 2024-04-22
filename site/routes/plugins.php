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
			$url = $plugins . '/plugins.json';

			if (kirby()->request()->header('X-Pull') === 'KeyCDN') {
				return Remote::get($url)->json();
			}

			go($url);
		}
	],
	[
		'pattern' => 'plugins/(:all).json',
		'action'  => function (string $path) use($plugins) {
			$url = $plugins . '/' . $path . '.json';

			if (kirby()->request()->header('X-Pull') === 'KeyCDN') {
				return Remote::get($url)->json();
			}

			go($url);
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
