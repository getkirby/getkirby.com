<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'entries' => $page
			->children()
			->listed()
			->filterBy('isEntry', true),
		'filter' => true
	];
};
