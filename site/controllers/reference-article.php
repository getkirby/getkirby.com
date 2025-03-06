<?php

use Kirby\Cms\Page;

return function (Page $page) {
	// if it's an subarticle of an article,
	// use the siblings of the parent article for entries list
	if ($page->depth() > 5) {
		$entry   = $page->parents()->flip()->nth(4);
		$entries = $entry->siblings()->listed()->filterBy('isDeprecated', false)->filterBy('isInternal', false);
	}

	return [
		'entry'   => $entry   ?? null,
		'entries' => $entries ?? null
	];
};
