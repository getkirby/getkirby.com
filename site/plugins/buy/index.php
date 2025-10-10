<?php

use Kirby\Buy\Product;
use Kirby\Buy\RevenueLimit;
use Kirby\Cms\App;

@include_once __DIR__ . '/vendor/autoload.php';

App::plugin('getkirby/buy', [
	'options' => [
		'cache' => true
	],
	'tags' => [
		'buy-price' => [
			'attr' => [
				'price'
			],
			'html' => function ($tag) {
				$product = Product::from($tag->value);
				$price   = $product->price('EUR');

				return match($tag->attr('price')) {
					'sale'    => $price->sale(),
					'upgrade' => $price->upgrade()->default(),
					default   => $price->regular(),
				};
			}
		],
		'revenue-limit' => [
			'html' => function ($tag) {
				return RevenueLimit::approximation(null, $tag->value === 'verbose');
			}
		]
	]
]);
