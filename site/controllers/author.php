<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'recipes' => page('docs/cookbook')
			->grandChildren()
			->listed()
			->filter(fn ($recipe) => $recipe->authors()->has($page))
			->sortBy('published', 'desc')
	];

};
