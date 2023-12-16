<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'discounts' => option('buy.volume'),
		'sale'      => new Buy\Sale(),
		'questions' => $page->find('answers')->children()
	];
};
