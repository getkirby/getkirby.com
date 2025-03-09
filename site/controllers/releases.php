<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'releases' => $page->children()->flip()
	];
};
