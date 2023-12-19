<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'authors' => $page->authors()
	];
};
