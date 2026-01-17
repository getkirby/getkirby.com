<?php

use Kirby\Buy\Paddle;
use Kirby\Buy\Product;
use Kirby\Honey\Time;
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
				'timestamp' => Time::get(),
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
		'pattern' => 'partners/preview/changes/(:any)',
		'action' => function ($slug) {

			$preview = page('partners')->children()->findBy('slug', $slug);

			if (!$preview || get('preview') !== $preview->preview()->value()) {
				go(page('error'));
			}

			if ($page = $preview->getChanges()) {
				return $page;
			}
			

		}
	]
];
