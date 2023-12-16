<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;

return function (App $kirby, Page $page, $filter) {

	$categories = $kirby->option('plugins.categories');
	$category   = param('category');
	$heading    = 'Featured';

	if ($category && array_key_exists($category, $categories) === true) {
		$plugins = $page
			->children()
			->children()
			->filterBy('recommended', '')
			->sortBy('title', 'asc');

		$plugins = $plugins->filterBy('category', $category);
		$heading = $categories[$category]['label'];

	} elseif ($category === 'all') {
		$heading  = 'All plugins';
		$category = 'all';
		$plugins  = $page
			->grandChildren()
			->sortBy('title', 'asc');
	} elseif ($filter === 'k4') {
		$heading  = 'Kirby 4 plugins';
		$category = 'k4';
		$plugins  = $page
			->grandChildren()
			->filter('versions', '*=', '4')
			->sortBy('title', 'asc');
	} elseif ($filter) {
		$heading = 'Newly added plugins';
		$plugins = $page->grandChildren()->filterBy('isNew', true);
	} else {
		$category = null;
		$plugins  = new Pages();

		if ($this->request()->url()->path()->first() !== 'plugins.json') {
			go('plugins/k4');
		}
	}

	return [
		'categories'      => $categories,
		'currentCategory' => $category,
		'heading'         => $heading,
		'plugins'         => $plugins,
		'filter'          => $filter,
	];

};
