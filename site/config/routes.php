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
		'pattern' => 'buy/prices/(:any?)',
		'action' => function (string $currency = 'EUR') {
			return json_encode([
				'basic' => [
					'regular' => Product::Basic->price($currency)->regular(),
					'sale'    => Product::Basic->price($currency)->sale(),
				],
				'enterprise' => [
					'regular' => Product::Enterprise->price($currency)->regular(),
					'sale'    => Product::Enterprise->price($currency)->sale()
				]
			]);
		}
	],
	[
		// TODO: Temporary test, remove this route again
		'pattern' => 'buy/currency-test',
		'action'  => function () {
			$visitor = \Buy\Paddle::visitor();
			$rates = Data::read(dirname(__DIR__) . '/plugins/buy/rates.json');

			$body = 'Detected IP:       ' . (\Buy\Visitor::ip() ?? 'N/A') . "\n" .
				'Detected country:  ' . ($visitor->country() ?? 'N/A') . "\n" .
				'Detected currency: ' . $visitor->currency() . "\n" .
				'Detected rate:     ' . $visitor->conversionRate() . ' (hardcoded for this currency: ' . $rates[$visitor->currency()] . ")\n" .
				'Status:            ' . ($visitor->error() ?? 'OK') . "\n\n" .
				'Example price:     ' . $visitor->currencySign() . "123\n" .
				'Revenue limit:     ' . $visitor->revenueLimit(1000000);


			return new \Kirby\Http\Response($body, 'text/plain');
		}
	],
	[
		'pattern' => 'buy/(:any)/(:any?)',
		'action' => function (string $product, string $currency = 'EUR') {
			try {
				$product = Product::from($product);
				$price   = $product->price($currency);
				$prices  = [
					'EUR:'                 . $product->price('EUR')->sale(),
					$price->currency . ':' . $price->sale(),
				];

				go($product->checkout('buy', ['prices' => $prices]));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		},
	],
	[
		'pattern' => 'buy/volume',
		'method'  => 'POST',
		'action'  => function() {
			$product  = get('product', 'basic');
			$currency = get('currency', 'EUR');
			$volume   = get('volume', 5);

			try {
				$product = Product::from($product);
				$price   = $product->price($currency);
				$prices  = [
					'EUR:'                 . $product->price('EUR')->volume($volume),
					$price->currency . ':' . $price->volume($volume),
				];

				$url = $product->checkout('buy', [
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
		'pattern' => 'buy/volume/(:any)/(:num)/(:any)',
		'action'  => function(string $product, int $volume, string $currency) {
			try {
				$product = Product::from($product);
				$price   = $product->price($currency);
				$prices  = [
					'EUR:'                 . $product->price('EUR')->volume($volume),
					$price->currency . ':' . $price->volume($volume),
				];

				$url = $product->checkout('buy', [
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
		'pattern' => 'plugins/k4',
		'action'  => function () {
			return page('plugins')->render(['filter' => 'k4']);
		}
	],
	[
		'pattern' => 'plugins/new',
		'action'  => function () {
			return page('plugins')->render(['filter' => 'published']);
		}
	],
];
