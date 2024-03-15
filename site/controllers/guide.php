<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;

return function (Page $page) {

	if ($page->isChapter()) {
		go($page->children()->first()->url());
	}

	$menu     = collection('guides')->group('category');
	$prevnext = new Pages();

	foreach ($menu as $guides) {
		foreach ($guides as $guide) {
			$prevnext->add($guide);
			$prevnext->add($guide->index()->listed());
		}
	}

	return [
		'guide'     => $page,
		'menu'      => $menu,
		'resources' => $page->resources()->toPages(),
		'prevnext'  => $prevnext->filterBy('isChapter', false)
	];
};
