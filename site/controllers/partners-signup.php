<?php

use Buy\Paddle;
use Buy\Passthrough;
use Buy\Product;
use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Http\Remote;

return function (App $kirby, Page $page) {
	// submitted form
	if ($kirby->request()->is('POST') === true) {
		$visitor      = Paddle::visitor();
		$timestamp    = explode(':', get('timestamp'));
		$people       = get('people');
		$peopleNum    = max(1, min(4, (int)$people));
		$plan         = get('plan');
		$renew        = get('renew');

		$businessName = get('businessName');
		$businessType = get('businessType');
		$location     = get('location');
		$summary      = get('summary');
		$website      = get('website');
		$address      = get('address');
		$projects     = (int)get('projects');
		$references   = get('references');
		$downloadLink = get('downloadLink');
		$name         = get('name');
		$email        = get('email');
		$discord      = get('discord');
		$notes        = get('notes');

		try {
			// generate checkout link data
			$product = Product::from('partner-' . $plan);
			$price   = $product->price();

			$eurPrice       = $product->price('EUR')->regular($peopleNum);
			$localizedPrice = $price->regular($peopleNum);

			$checkoutData = [
				'expires'     => date('Y-m-d', strtotime('+2 months')),
				'passthrough' => new Passthrough(multiplier: $peopleNum),
				'prices'      => [
					'EUR:' . $eurPrice,
					$price->currency . ':' . $localizedPrice,
				]
			];

			// handle renewals
			if ($renew) {
				if (!($renew = page('partners')->find($renew))) {
					throw new Exception('Cannot renew partnership for unknown partner.');
				}

				$checkoutData['passthrough']->partner = $renew->uid();

				$checkout = $product->checkout('buy', [
					...$checkoutData,
					'return_url' => url('partners/join/success/partnership:renewed')
				]);

				go($checkout);
				return;
			}

			// prevent submissions faster than 1 minute (spam protection)
			// (only needed for new applications because otherwise
			// there will be a redirect to Paddle)
			if ($timestamp[0] > time() - 60) {
				throw new Exception('To protect against spam, we block submissions faster than 1 minute. Please try again, sorry for the inconvenience.');
			}

			$timestampHash = hash_hmac('sha256', $timestamp[0], 'kirby');

			if (hash_equals($timestampHash, $timestamp[1]) !== true) {
				throw new Exception('Spam protection hash was manipulated');
			}

			// submit form values to Airtable
			$response = Remote::post('https://api.airtable.com/v0/appeeHREbUMMaZGRP/tblrKOCF0cGAZmUQR', [
				'data' => json_encode([
					'fields' => [
						'Name'                    => $businessName,
						'Status'                  => 'Need to review',
						'Plan'                    => $plan,
						'People'                  => $people,
						'Price'                   => $visitor->currencySign() . $localizedPrice,
						'Checkout'                => $product->checkout('buy', $checkoutData),
						'Business type'           => $businessType,
						'Own website'             => $website,
						'Contact person'          => $name,
						'Email'                   => $email,
						'Discord'                 => $discord,
						'Listing location'        => $location,
						'Address'                 => $address,
						'Listing description'     => $summary,
						'Number of projects'      => $projects,
						'References'              => $references,
						'Review project download' => $downloadLink,
						'Notes'                   => $notes,
					]
				]),
				'headers' => [
					'Authorization' => 'Bearer ' . option('keys.airtable'),
					'Content-Type'  => 'application/json',
				]
			])->json();

			if (isset($response['error']) === true) {
				throw new Exception($response['error']['message'] . '(' . $response['error']['type'] . ')');
			}

			go('partners/join/success');

		} catch (Throwable $e) {
			$message = $e->getMessage();
		}
	}

	// prefill form for renewals
	if ($renew = param('renew')) {
		if ($renew = page('partners')->find($renew)) {
			$plan   = $renew->plan()->value();
			$people = $renew->people()->value();
		}
	}

	return [
		'certified' => Product::PartnerCertified,
		'message'   => $message ?? null,
		'people'    => $people ?? null,
		'plan'      => $plan ?? 'certified',
		'questions' => $page->find('answers')->children(),
		'regular'   => Product::PartnerRegular,
		'renew'     => $renew ?? null,
	];
};
