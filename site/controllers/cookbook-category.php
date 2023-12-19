<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'recipes' => match ($page->slug()) {
			'new' => page('docs/cookbook')
				->children()
				->listed()
				->children()
				->listed()
				->filterBy('isNew', true),

			default => $page
				->children()
				->listed()
				->sortBy('published', 'desc')
		}
	];
};
