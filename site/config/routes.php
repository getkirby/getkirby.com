<?php

return [
	[
		// blocks all requests to *.html and returns 404
		'pattern' => '(:all)\.html',
		'action'  => function () {
			return false;
		}
	],
	...require dirname(__DIR__) . '/routes/buy.php',
	...require dirname(__DIR__) . '/routes/docs.php',
	...require dirname(__DIR__) . '/routes/legacy.php',
	...require dirname(__DIR__) . '/routes/partners.php',
	...require dirname(__DIR__) . '/routes/plugins.php',
	...require dirname(__DIR__) . '/routes/releases.php',
	[
		'pattern' => '.well-known/security.txt',
		'action'  => fn () => go('security.txt')
	],
	[
		'pattern' => '.well-known/atproto-did',
		'action'  => fn () => 'did:plc:saf6ox5ysclcv6ic44xd6rsz'
	],
	[
		'pattern' => 'hooks/clean',
		'method'  => 'GET|POST',
		'action'  => function () {
			$key = option('keys.hooks');

			if (empty($key) === false && get('key') === $key) {
				kirby()->cache('diffs')->flush();
				kirby()->cache('pages')->flush();
				kirby()->cache('reference')->flush();
			}

			go();
		}
	],
	[
		'pattern' => 'brands/(:all?)',
		'action' => function () {
			go('/');
		}
	],
	[
		'pattern' => 'features/(:any?)',
		'action' => function (string $feature = '') {
			go('/for/' . $feature);
		}
	],
	[
		'pattern' => 'pixels',
		'action'  => function () {
			go('https://pixels.getkirby.com');
		}
	],
	[
		'pattern' => 'llms.txt',
		'action'  => function () {
			$sections = [
				'guide',
				'reference',
				'cookbook',
				'quicktips'
			];

			$docs = page('docs')
				->children()
				->find(...$sections)
				->listed();

			kirby()->response()->type('text/plain');

			return snippet('docs/llms/index', ['docs' => $docs], true);
		}
	],
];
