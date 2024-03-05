<?php

use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

return function (Page $page, string|null $tag = null) {
	$recipes = $page->grandChildren()->listed();

	if ($tag) {
		$recipes = $recipes->filter(function($recipe) use($tag) {
			$tags = array_map(
				fn ($item) => Str::slug($item),
				$recipe->tags()->split(',')
			);
			return in_array($tag, $tags, true);
		});
	}

	return [
		'recipes' => $recipes->sortBy('published', 'desc'),
		'tag'     => $tag
	];
};
