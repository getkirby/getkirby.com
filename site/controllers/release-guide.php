<?php

use Kirby\Cms\Page;

return function (Page $page) {
	if ($page->link()->isNotEmpty() === true) {
		go($page->link());
	}
};
