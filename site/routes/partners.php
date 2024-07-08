<?php

use Buy\Paddle;
use Buy\Product;
use Kirby\Http\Response;

return [
	[
		'pattern' => 'partners/join/prices',
		'action' => function () {
			$regular   = Product::PartnerRegular;
			$certified = Product::PartnerCertified;
			$visitor   = Paddle::visitor();

			// spam protection honeytime
			$timestamp  = time();
			$timestamp .= ':' . hash_hmac('sha256', $timestamp, 'kirby');

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
				'timestamp' => $timestamp,
			], JSON_UNESCAPED_UNICODE);

			return Response::json(
				$json,
				headers: [
					'Cache-Control' => 'max-age=10800, private'
				]
			);
		}
	],
];
