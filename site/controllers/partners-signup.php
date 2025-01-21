<?php

use Kirby\Buy\Paddle;
use Kirby\Buy\Passthrough;
use Kirby\Buy\Product;
use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Discord\Discord;
use Kirby\Honey\Time;
use Kirby\Http\Remote;

return function (App $kirby, Page $page) {
	// submitted form
	if ($kirby->request()->is('POST') === true) {
		$visitor      = Paddle::visitor();
		$timestamp    = get('timestamp');
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
				$partner = page('partners')->find($renew);
				if (!$partner) {
					throw new Exception('Cannot renew partnership for unknown partner.');
				}

				$checkoutData['passthrough']->partner = $partner->uid();

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
			Time::validate($timestamp);

			// submit form values to Airtable
			$response = Remote::post('https://api.airtable.com/v0/appeeHREbUMMaZGRP/tblrKOCF0cGAZmUQR', [
				'data' => json_encode([
					'fields' => [
						'Name'                    => $businessName,
						'Status'                  => 'Send notification of receipt',
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

			// Send a Discord webhook on success
			// Discord::submit(
			// 	username: 'getkirby.com/partners',
			// 	webhook: option('keys.discord.hooks.partners'),
			// 	title: '🦹 New Partner Application',
			// 	color: '#ebc747',
			// 	description: $website,
			// 	author: [
			// 		'name' => $name,
			// 		'url'  => $website,
			// 		'icon' => gravatar($email, 'retro')
			// 	],
			// 	fields: [
			// 		[
			// 			'name'  => 'Business Type',
			// 			'value' => $businessName
			// 		],
			// 		[
			// 			'name'  => 'Location',
			// 			'value' => $location
			// 		],
			// 		[
			// 			'name'  => 'Plan',
			// 			'value' => $plan
			// 		],
			// 		[
			// 			'name'  => 'People',
			// 			'value' => $people
			// 		],
			// 	],
			// );

			go('partners/join/success');
		} catch (Throwable $e) {
			$message = $e->getMessage();
		}
	}

	// prefill form for renewals
	if ($renew = param('renew')) {
		if ($partner = page('partners')->find($renew)) {
			$plan   = $partner->plan()->value();
			$people = $partner->people()->value();
		}
	}
	/**
	 * @var Page|null $renew
	 */
	return [
		'certified' => Product::PartnerCertified,
		'message'   => $message ?? null,
		'people'    => $people ?? null,
		'plan'      => $plan ?? 'certified',
		'questions' => $page->find('answers')->children(),
		'regular'   => Product::PartnerRegular,
		'renew'     => $partner ?? null,
	];
};
