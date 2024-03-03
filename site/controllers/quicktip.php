<?php

use Kirby\Cms\Page;

return function (Page $page) {
	$tags = $page->siblings(true)->listed()->pluck('tags', ',', true);
	sort($tags);
	return [
		'authors' => $page->authors(),
		'tags'    => $tags,
	];
};
