<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'issues' => $page->children()->flip(),
	];
};
