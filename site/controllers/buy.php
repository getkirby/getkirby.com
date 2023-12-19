<?php

use Kirby\Cms\Page;

return function (Page $page) {
	$sale = new Buy\Sale();

	// expire the cache when the sale banner/prices change
	$sale->expires();

	return [
		'discounts' => option('buy.volume'),
		'sale'      => $sale,
		'questions' => $page->find('answers')->children()
	];
};
