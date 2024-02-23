<?php

use Kirby\Cms\Page;

return function (Page $page) {
	$sale = new Buy\Sale();

	// expire the cache when the sale banner/prices change
	$sale->expires();

	$discounts = option('buy.volume');
	$discountsReversed = $discounts;
	krsort($discountsReversed);

	return [
		'basic'               => Buy\Product::Basic,
		'countries'           => option('countries'),
		'discounts'           => $discounts,
		'discountsReversed'   => $discountsReversed,
		'donation'            => option('buy.donation'),
		'enterprise'          => Buy\Product::Enterprise,
		'sale'                => $sale,
		'questions'           => $page->find('answers')->children(),
		'revenueLimitShort'   => Buy\RevenueLimit::approximation(),
		'revenueLimitVerbose' => Buy\RevenueLimit::approximation(verbose: true),
	];
};
