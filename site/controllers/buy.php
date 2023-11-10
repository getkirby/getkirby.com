<?php

return function ($page) {
	return [
		'banner'    => banner(),
		'discounts' => option('buy.volume'),
		'questions' => $page->find('answers')->children()
	];
};
