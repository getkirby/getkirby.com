<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'entries' => $page
			->children()
			->listed()
			->filterBy('isDeprecated', false)
	];
};
