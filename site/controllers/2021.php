<?php

use Kirby\Cms\Page;
use Kirby\Data\Data;

return function (Page $page) {
	$contributors = $page->contributors()->yaml();
	$plugins      = page('plugins')->children()->children();
	$plugins2021  = Data::read($page->root() . '/plugins-2021.yaml');
	$plugins2021  = $plugins->find($plugins2021)->sortBy('title', 'asc');

	sort($contributors);

	return [
		'authors'      => page('authors')->children(),
		'contributors' => $contributors,
		'issues'       => page('kosmos')->children()->filterBy('num', '>=', '20210101')->filterBy('num', '<=', '20211231')->sortBy('num', 'desc'),
		'plugins'      => $plugins,
		'plugins2021'  => $plugins2021,
		'releases'     => Data::read($page->file('releases.json')->root()),
		'recipes'      => page('docs/cookbook')->children()->children()->filterBy('published', '>=', '2021-01-01')->filterBy('published', '<=', '2021-12-31')->sortBy('published', 'desc')
	];
};
