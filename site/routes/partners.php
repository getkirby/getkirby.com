<?php

use Buy\Paddle;
use Buy\Passthrough;
use Buy\Product;
use Kirby\Http\Response;

return [
	[
		'pattern' => 'partners/join/prices',
		'action' => function () {
			$regular   = Product::PartnerRegular;
			$certified = Product::PartnerCertified;
			$visitor   = Paddle::visitor();

			$json = json_encode([
				'status'   => $visitor->error() ?? 'OK',
				'country'  => $visitor->country(),
				'currency' => $visitor->currencySign(),
				'prices' => [
					'regular' => [
						'1'  => $regular->price()->regular(1),
						'2'  => $regular->price()->regular(2),
						'3'  => $regular->price()->regular(3),
						'4+' => $regular->price()->regular(4),
					],
					'certified' => [
						'1'  => $certified->price()->regular(1),
						'2'  => $certified->price()->regular(2),
						'3'  => $certified->price()->regular(3),
						'4+' => $certified->price()->regular(4),
					],
				],
			], JSON_UNESCAPED_UNICODE);

			return Response::json(
				$json,
				headers: [
					'Cache-Control' => 'max-age=10800, private'
				]
			);
		}
	],
	[
		'pattern' => 'partners/join',
		'method'  => 'POST',
		'action' => function () {
			$tier      = get('tier');
			$people    = get('people');
			$peopleNum = max(1, min(4, (int)$people));
			$visitor   = Paddle::visitor();

			try {
				$product = Product::from('partner-' . $tier);
				$price   = $product->price();

				$eurPrice       = $product->price('EUR')->regular($peopleNum);
				$localizedPrice = $price->regular($peopleNum);

				$prices  = [
					'EUR:' . $eurPrice,
					$price->currency . ':' . $localizedPrice,
				];

				$checkout = $product->checkout('buy', [
					'expires' => date('Y-m-d', strtotime('+2 months')),
					'prices'  => $prices,
				]);

				$query = [
					'prefill_Plan'     => $tier,
					'prefill_People'   => $people,
					'prefill_Price'    => $visitor->currencySign() . $localizedPrice,
					'prefill_Checkout' => $checkout,
					'hide_Plan'        => 'true',
					'hide_People'      => 'true',
					'hide_Price'       => 'true',
					'hide_Checkout'    => 'true',
				];

				go('https://airtable.com/appeeHREbUMMaZGRP/shrJ8YnBiGasgcO5F?' . http_build_query($query));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		},
	],
];
