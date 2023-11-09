<?php

use Kirby\Cms\Pages;
use Composer\Semver\Semver;

return function ($kirby, $page, $filter) {

	$categories = option('plugins.categories');
	$category   = param('category');
	$version    = param('version');
	$heading    = 'Featured';
	$versions   = array_filter($kirby->option('versions'), fn ($item) => ($item['hasFilter'] ?? false) === true);
	krsort($versions);

	if ($category && array_key_exists($category, $categories) === true) {
		$plugins = $page
			->children()
			->children()
			->filterBy('recommended', '')
			->sortBy('title', 'asc');

		$plugins = $plugins->filterBy('category', $category);
		$heading = $categories[$category]['label'];
	} elseif (empty($version) === false && array_key_exists($version, $versions)) {
		$category = 'all';
		$heading  = $version . ' compatible plugins';
		$plugins  = $page
			->grandChildren()
			->filter(function ($plugin) use ($version) {
				if ($plugin->versions()->isEmpty()) {
					return false;
				}

				return Semver::satisfies($version, $plugin->versions()->value());
			})
			->sortBy('title', 'asc');
	} else if ($category === 'all') {
		$heading  = 'All plugins';
		$category = 'all';
		$plugins  = $page
			->grandChildren()
			->sortBy('title', 'asc');
	} elseif ($filter) {
		$heading = 'Newly added plugins';
		$plugins = $page->grandChildren()->filterBy('isNew', true);
	} else {
		$category = null;
		$plugins  = new Pages();
	}

	return [
		'categories' => $categories,
		'currentCategory' => $category,
		'heading' => $heading,
		'plugins' => $plugins,
		'filter' => $filter,
		'currentVersion' => $version,
		'versions' => $versions,
	];

};
