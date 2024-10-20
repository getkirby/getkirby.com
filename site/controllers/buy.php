<?php

use Kirby\Buy\Product;
use Kirby\Buy\RevenueLimit;
use Kirby\Buy\Sale;
use Kirby\Cms\Page;

return function (Page $page) {
	$sale = new Sale();

	// expire the cache when the sale banner/prices change
	$sale->expires();

	$discounts = option('buy.volume');
	$discountsReversed = $discounts;
	krsort($discountsReversed);

	return [
		'basic'             => Product::Basic,
		'countries'         => option('countries'),
		'discounts'         => $discounts,
		'discountsReversed' => $discountsReversed,
		'donation'          => option('buy.donation'),
		'enterprise'        => Product::Enterprise,
		'sale'              => $sale,
		'questions'         => $page->find('answers')->children(),
		'revenueLimit'      => RevenueLimit::approximation(verbose: true),
	];
};
