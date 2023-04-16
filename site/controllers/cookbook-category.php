<?php

return function ($page) {

	if ($page->slug() === 'new') {
		$recipes = page('docs/cookbook')
			->children()
			->listed()
			->children()
			->listed()
			->filterBy('isNew', true);
	} else {
		$recipes = $page
			->children()
			->listed()
			->sortBy('published', 'desc');
	}

	return [
		'recipes' => $recipes
	];

};
