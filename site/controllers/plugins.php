<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;

return function (App $kirby, Page $page, $filter) {

	$categories = $kirby->option('plugins.categories');
	$category   = param('category');
	$heading    = 'Featured';

	// get all plugins
	$plugins = $page
		->grandChildren()
		->filter('archived', '')
		->sortBy('title', 'asc');


	if ($category && array_key_exists($category, $categories) === true) {
		$heading = $categories[$category]['label'];
		$plugins = $plugins->filter('recommended', '')->filter('category', $category);
	} elseif ($category === 'all') {
		$heading  = 'All plugins';
		$category = 'all';
	} elseif ($filter === 'k4') {
		$heading  = 'Kirby 4 plugins';
		$category = 'k4';
		$plugins  = $plugins->filter('versions', '*=', '4');
	} elseif ($filter) {
		$heading = 'Newly added plugins';
		$plugins = $plugins->filter('isNew', true);
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
