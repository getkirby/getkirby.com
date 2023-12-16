<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'sections' => $page->children()->listed()->filter(
			fn ($section) => file_exists($section->root() . '/snippet.php')
		),
	];
};
