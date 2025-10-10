<?php

use Kirby\Buy\Paddle;
use Kirby\Buy\Passthrough;
use Kirby\Buy\Product;
use Kirby\Http\Response;

return [
	[
		'pattern' => 'buy/prices',
		'action' => function () {
			$basic      = Product::Basic;
			$enterprise = Product::Enterprise;
			$visitor    = Paddle::visitor(country: get('country'));

			$json = json_encode([
				'status'       => $visitor->error() ?? 'OK',
				'country'      => $visitor->country(),
				'currency'     => $visitor->currency(),
				'currencySign' => $visitor->currencySign(),
				'prices' => [
					'basic' => [
						'regular' => $basic->price()->regular(),
						'sale'    => $basic->price()->sale(),
						'upgrade' => $basic->price()->upgrade()->default()
					],
					'donation' => [
						'customer' => $basic->price()->customerDonation(),
						'team'     => $basic->price()->teamDonation(),
					],
					'enterprise' => [
						'regular' => $enterprise->price()->regular(),
						'sale'    => $enterprise->price()->sale(),
						'upgrade' => $enterprise->price()->upgrade()->default()
					],
				],
				'revenueLimit' => $visitor->currency() !== 'EUR' ? ' (' . $visitor->revenueLimit() . ')' : '',
				'vatRate'      => $visitor->vatRate() ?? 0,
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
		'pattern' => 'buy',
		'method'  => 'POST',
		'action' => function () {
			$city       = get('city');
			$company    = get('company');
			$country    = get('country');
			$donate     = get('donate') === 'on';
			$email      = get('email');
			$newsletter = get('newsletter') === 'on';
			$productId  = get('product');
			$postalCode = get('postalCode');
			$state      = get('state');
			$street     = get('street');
			$quantity   = Product::restrictQuantity(get('quantity', 1));
			$vatId      = get('vatId');

			try {
				// use the provided country for the calculation, not the IP address
				Paddle::visitor(country: $country);

				$product     = Product::from($productId);
				$price       = $product->price();
				$message     = $product->revenueLimit();
				$passthrough = new Passthrough(
					discounts:    $price->discounts(),
					newsletter:   $newsletter,
					donationOrg:  option('buy.donation.charity'),
					teamDonation: option('buy.donation.teamAmount') * $quantity
				);

				$eurPrice       = $product->price('EUR')->volume($quantity);
				$localizedPrice = $price->volume($quantity);

				if ($donate === true) {
					// prices per license
					$customerDonation = option('buy.donation.customerAmount');
					$eurPrice       += $customerDonation;
					$localizedPrice += $price->convert($customerDonation);

					// donation overall
					$customerDonation *= $quantity;
					$passthrough->customerDonation = $customerDonation;

					$message .= ' We will donate an additional €' . $customerDonation . ' to ' . option('buy.donation.charity') . '. Thank you for your donation!';
				}

				$prices  = [
					'EUR:' . $eurPrice,
					$price->currency . ':' . $localizedPrice,
				];

				go($product->checkout('buy', [
					'custom_message'    => $message,
					'customer_country'  => $country,
					'customer_email'    => $email,
					'customer_postcode' => $postalCode,
					'passthrough'       => $passthrough,
					'prices'            => $prices,
					'quantity'          => $quantity,
					'vat_city'          => $city,
					'vat_country'       => $country,
					'vat_company_name'  => $company,
					'vat_number'        => $vatId,
					'vat_postcode'      => $postalCode,
					'vat_state'         => $state,
					'vat_street'        => $street,
				]));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		},
	],
	[
		'pattern' => 'buy/(enterprise|basic)',
		'action' => function (string $productId) {
			try {
				$product     = Product::from($productId);
				$price       = $product->price();
				$passthrough = new Passthrough(
					discounts:    $price->discounts(),
					donationOrg:  option('buy.donation.charity'),
					teamDonation: option('buy.donation.teamAmount')
				);

				$eurPrice       = $product->price('EUR')->sale();
				$localizedPrice = $price->sale();

				$prices  = [
					'EUR:' . $eurPrice,
					$price->currency . ':' . $localizedPrice,
				];

				header('Cache-Control: no-store');
				go($product->checkout('buy', compact('prices', 'passthrough')));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		},
	],
	[
		'pattern' => 'buy/volume',
		'method'  => 'POST',
		'action'  => function () {
			$productId = get('product', 'basic');
			$quantity  = Product::restrictQuantity(get('volume', 5));

			try {
				$product     = Product::from($productId);
				$price       = $product->price();
				$passthrough = new Passthrough(
					discounts:    $price->discounts(),
					donationOrg:  option('buy.donation.charity'),
					teamDonation: option('buy.donation.teamAmount') * $quantity
				);

				$eurPrice       = $product->price('EUR')->volume($quantity);
				$localizedPrice = $price->volume($quantity);

				$prices  = [
					'EUR:' . $eurPrice,
					$price->currency . ':' . $localizedPrice,
				];

				go($product->checkout('buy', compact('prices', 'quantity', 'passthrough')));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		}
	],
	[
		'pattern' => 'buy/volume/(enterprise|basic)/(:num)',
		'action'  => function (string $productId, int $quantity) {
			$quantity = Product::restrictQuantity($quantity);

			try {
				$product     = Product::from($productId);
				$price       = $product->price();
				$passthrough = new Passthrough(
					discounts:    $price->discounts(),
					donationOrg:  option('buy.donation.charity'),
					teamDonation: option('buy.donation.teamAmount') * $quantity
				);

				$prices  = [
					'EUR:' . $product->price('EUR')->volume($quantity),
					$price->currency . ':' . $price->volume($quantity),
				];

				header('Cache-Control: no-store');
				go($product->checkout('buy', compact('prices', 'quantity', 'passthrough')));
			} catch (Throwable $e) {
				die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
			}
		}
	]
];
