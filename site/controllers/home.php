<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

return function (App $kirby, Page $page) {
	$story   = $page->find(get('your') ?? 'company');
	$stroy ??= $page->find('company');

	return [
		'stories'    => $page->children()->listed(),
		'story'      => $story,
		'storyImage' => $story->images()->findBy('name', 'panel'),
		'version'    => implode('.', array_slice(Str::split($kirby->version(), '.'), 0, 2)),
	];
};
