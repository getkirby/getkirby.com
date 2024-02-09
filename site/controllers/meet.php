<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'events'  => $page->find('events')->children(),
		'gallery' => $page->find('gallery')->images()->sortBy('sort'),
	];
};
