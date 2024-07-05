<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Data\Data;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

return function (Page $page) {
	$contributors = $page->contributors()->yaml();
	$plugins      = A::map(
		Data::read($page->root() . '/plugins-2021.yaml'),
		fn ($plugin) => new Page([
			'slug'    => $plugin,
			'content' => [
				'title' => Str::after($plugin, 'plugins/')
			]
		])
	);

	sort($contributors);

	return [
		'authors'      => page('authors')->children(),
		'contributors' => $contributors,
		'issues'       => page('kosmos')->children()->filterBy('num', '>=', '20210101')->filterBy('num', '<=', '20211231')->sortBy('num', 'desc'),
		'plugins'      => (new Pages($plugins))->sortBy('title', 'asc'),
		'releases'     => Data::read($page->file('releases.json')->root()),
		'recipes'      => page('docs/cookbook')->children()->children()->filterBy('published', '>=', '2021-01-01')->filterBy('published', '<=', '2021-12-31')->sortBy('published', 'desc')
	];
};
