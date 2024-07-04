<?php

use Buy\Paddle;
use Buy\Product;
use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Http\Remote;

return function (App $kirby, Page $page) {
	if ($kirby->request()->is('POST') === true) {
		$timestamp    = explode(':', get('timestamp'));
		$people       = get('people');
		$peopleNum    = max(1, min(4, (int)$people));
		$tier         = get('tier');
		$businessName = get('businessName');
		$businessType = get('businessType');
		$location     = get('location');
		$description  = get('description');
		$website      = get('website');
		$address      = get('address');
		$projects     = (int)get('projects');
		$references   = get('references');
		$downloadLink = get('downloadLink');
		$name         = get('name');
		$email        = get('email');
		$discord      = get('discord');
		$notes        = get('notes');
		$visitor      = Paddle::visitor();

		try {
			// prevent submissions faster than 1 minute (spam protection)
			if ($timestamp[0] > time() - 60) {
				throw new Exception('To protect against spam, we block submissions faster than 1 minute. Please try again, sorry for the inconvenience.');
			}

			$timestampHash = hash_hmac('sha256', $timestamp[0], 'kirby');
			if (hash_equals($timestampHash, $timestamp[1]) !== true) {
				throw new Exception('Spam protection hash was manipulated');
			}

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

			$response = Remote::post('https://api.airtable.com/v0/appeeHREbUMMaZGRP/tblrKOCF0cGAZmUQR', [
				'data' => json_encode([
					'fields' => [
						'Name'                    => $businessName,
						'Status'                  => 'Need to review',
						'Plan'                    => $tier,
						'People'                  => $people,
						'Price'                   => $visitor->currencySign() . $localizedPrice,
						'Checkout'                => $checkout,
						'Business type'           => $businessType,
						'Own website'             => $website,
						'Contact person'          => $name,
						'Email'                   => $email,
						'Discord'                 => $discord,
						'Listing location'        => $location,
						'Address'                 => $address,
						'Listing description'     => $description,
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

			$status  = 'success';
			$message = 'Thank you for your application! We will get in touch with you soon.';
		} catch (Throwable $e) {
			$status  = 'alert';
			$message = $e->getMessage();
		}
	}

	if ($renew = param('renew')) {
		if ($renew = page('partners')->find($renew)) {
			$people = $renew->people()->value();
		}
	}

	return [
		'certified' => Product::PartnerCertified,
		'message'   => $message ?? null,
		'people'    => $people ?? null,
		'questions' => $page->find('answers')->children(),
		'regular'   => Product::PartnerRegular,
		'renew'     => $renew ?? null,
		'status'    => $status ?? null,
	];
};
