<?php

use Buy\Paddle;
use Buy\Product;
use Kirby\Cms\App;
use Kirby\Cms\Page;

return function (App $kirby, Page $page) {
	$statusMessage = $statusType = null;

	if ($kirby->request()->is('POST') === true) {
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
			$statusMessage = $e->getMessage();
			$statusType    = 'alert';
		}
	}

	return [
		'certified'     => Product::PartnerCertified,
		'questions'     => $page->find('answers')->children(),
		'regular'       => Product::PartnerRegular,
		'statusMessage' => $statusMessage,
		'statusType'    => $statusType,
	];
};
