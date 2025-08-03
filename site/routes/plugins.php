<?php

use Kirby\Http\Remote;
use Kirby\Http\Response;

$plugins = 'https://plugins.getkirby.com';

return [
	[
		'pattern' => 'plugins/create',
		'action'  => fn () => page('plugins/create')
	],
	[
		'pattern' => 'plugins/k4',
		'action'  => fn () => go($plugins . '/supports/4')
	],
	[
		'pattern' => 'plugins.json',
		'action'  => fn () => go($plugins . '/plugins.json')
	],
	[
		'pattern' => 'plugins/(:all).json',
		'action'  => function (string $path) use($plugins) {
			$url = $plugins . '/' . $path . '.json';

			if (kirby()->request()->header('X-Pull') === option('keys.keycdn')) {
				$json    = Remote::get($url)->json();
				$headers = [
					// keep the data in the client cache for a day,
					// but refresh the data in the CDN cache every half an hour;
					// if getkirby.com is not reachable, continue to serve the data for two days
					'Cache-Control' => 'public, max-age=86400, s-maxage=1800, stale-if-error=172800'
				];

				if (is_array($json) === true) {
					return Response::json($json, headers: $headers);
				}

				return new Response('Plugin not found', 'text/plain', 404, $headers);
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
