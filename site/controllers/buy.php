<?php

return function ($page) {
	return [
		'discounts' => option('buy.volume'),
		'sale'      => new Buy\Sale(),
		'questions' => $page->find('answers')->children()
	];
};
