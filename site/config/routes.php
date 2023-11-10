<?php

use Buy\Product;
use Kirby\Cms\Page;

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
		'pattern' => 'buy/prices/(:any)',
		'action' => function (string $currency) {
			return json_encode([
				'basic'      => Product::Basic->price($currency)->sale(),
				'enterprise' => Product::Enterprise->price($currency)->sale()
			]);
		}
	],
	[
		'pattern' => 'buy/(:any)/(:any)',
		'action' => function (string $product, string $currency) {
			try {
				$product = Product::from($product);
				$prices  = [
					'EUR:'          . $product->price('EUR')->sale(),
					$currency . ':' . $product->price($currency)->sale(),
				];

				go($product->checkout(['prices' => $prices]));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		},
	],
	[
		'pattern' => 'buy/volume/(:any)/(:num)/(:any)',
		'action'  => function(string $product, int $volume, string $currency) {
			try {
				$product  = Product::from($product);
				$prices  = [
					'EUR:'          . $product->price('EUR')->volume($volume),
					$currency . ':' . $product->price($currency)->volume($volume),
				];

				$url = $product->checkout([
					'prices'            => $prices,
					'quantity'          => $volume,
					'quantity_variable' => false,
				]);

				go($url);
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
