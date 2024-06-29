<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'questions' => $page->find('answers')->children(),
	];
};
