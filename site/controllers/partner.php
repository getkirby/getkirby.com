<?php

use Kirby\Cms\Page;

return function (Page $page) {
	if (
		$page->status() !== 'listed' &&
		get('preview') !== $page->preview()->value()
	) {
		go($page->parent());
	}
};
