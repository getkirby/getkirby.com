<?php

use Kirby\Cms\App;

return function (App $kirby) {
	if (isArchived() === true) {
		go('https://getkirby.com/' . $kirby->path());
	}
};
