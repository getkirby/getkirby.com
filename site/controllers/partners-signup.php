<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'certified' => Buy\Product::PartnerCertified,
		'questions' => $page->find('answers')->children(),
		'regular'   => Buy\Product::PartnerRegular,
	];
};
