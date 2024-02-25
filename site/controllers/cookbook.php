<?php

use Kirby\Cms\Page;

return function (Page $page, $tag) {
	
	$recipes = $page->grandChildren()->listed();
	
	if ($tag) {
		$recipes = $recipes->filter(function($recipe) use($tag) {
			$tags = array_map(fn ($item) => Str::slug($item), $recipe->tags()->split(','));
			return in_array($tag, $tags, true);
		});
	}

	return [
		'recipes' => $recipes,
		'tag'     => $tag,
	];
};
