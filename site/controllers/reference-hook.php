<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'parameters' => $page->parameters(),
	];
};
