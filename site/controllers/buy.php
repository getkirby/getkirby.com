<?php

use Kirby\Paddle\Checkout;

return function ($page) {
	$checkout = new Checkout();
	return [
		'banner'    => banner(),
		'discounts' => array_slice($checkout->discounts(), 0, 3, true),
		'product'   => $checkout->product(),
		'questions' => $page->find('answers')->children()
	];
};
