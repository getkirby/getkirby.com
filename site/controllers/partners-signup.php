<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'requirements' => $page->requirements()->yaml(),
		'benefits'     => $page->benefits()->yaml(),
		'packages'     => $page->packages()->yaml(),
		'questions'    => $page->find('answers')->children(),
	];
};
