<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'attributes' => $page->reflection()->attributes(),
	];
};
