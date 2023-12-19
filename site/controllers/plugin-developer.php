<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;

return function (App $kirby, Page $page) {
	return [
		'author'          => $page,
		'authorPlugins'   => $page->children(),
		'categories'      => $kirby->option('plugins.categories'),
		'currentCategory' => null
	];
};
