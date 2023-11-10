<?php

return [
	[
		'pattern' => '.well-known/security.txt',
		'action'  => function () {
			go('security.txt');
		}
	],
	[
		'pattern' => 'hooks/clean',
		'method'  => 'GET|POST',
		'action'  => function () {
			$key = option('keys.hooks');

			if (empty($key) === false && get('key') === $key) {
				kirby()->cache('pages')->flush();
				kirby()->cache('diffs')->flush();
				kirby()->cache('plugins')->flush();
				kirby()->cache('reference')->flush();
			}

			go();
		}
	],
	[
		'pattern' => 'releases/(:num)\-(:any)',
		'action'  => function ($generation, $major) {
			return go('releases/' . $generation . '.' . $major);
		}
	],
	[
		'pattern' => 'releases/(:num)\.(:any)',
		'action'  => function ($generation, $major) {
			return page('releases/' . $generation . '-' . $major);
		}
	],
	[
		'pattern' => 'releases/(:num)\.(:any)/(:all?)',
		'action'  => function ($generation, $major, $path) {
			return page('releases/' . $generation . '-' . $major . '/' . $path);
		}
	],
	[
		'pattern' => 'buy/checkout/(:any)',
		'action'  => function($volume) {
			try {
				$checkout = new Kirby\Paddle\Checkout();
				go($checkout->url($volume));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		}
	],
	[
		'pattern' => 'pixels',
		'action'  => function () {
			return new Page([
				'slug'     => 'pixels',
				'template' => 'pixels',
				'content'  => [
					'title' => 'Pixels'
				]
			]);
		}
	],
	[
		'pattern' => 'plugins/v4',
		'action'  => function () {
			return page('plugins')->render(['filter' => 'v4']);
		}
	],
	[
		'pattern' => 'plugins/new',
		'action'  => function () {
			return page('plugins')->render(['filter' => 'published']);
		}
	],
];
