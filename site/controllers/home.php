<?php

use Kirby\Toolkit\Str;

return function ($kirby, $page) {
	$storyId    = get('your') ?? 'company';
	$story      = $page->find($storyId) ?? $page->find('company');
	$storyImage = $story->images()->findBy('name', 'panel');

	return [
		'stories'    => $page->children()->listed(),
		'story'      => $story,
		'storyImage' => $storyImage,
		'version'    => implode('.', array_slice(Str::split($kirby->version(), '.'), 0, 2)),
	];
};
