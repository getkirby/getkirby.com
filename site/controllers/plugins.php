<?php

use Kirby\Cms\Pages;

return function($page, $filter) {

	$categories = option('plugins.categories');
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

	} else if ($category === 'all') {
			$heading  = 'All plugins';
			$category = 'all';
			$plugins  = $page
					->children()
					->children()
					->sortBy('title', 'asc');
	} elseif ($filter) {
			$heading = 'Newly added plugins';
			$plugins = $page->grandChildren()->filterBy('isNew', true);
	} else {
		$category = null;
		$plugins  = new Pages();
	}
		return [
		'categories'      => $categories,
		'currentCategory' => $category,
		'heading'         => $heading,
		'plugins'         => $plugins,
		'filter'          => $filter,
	];

};
