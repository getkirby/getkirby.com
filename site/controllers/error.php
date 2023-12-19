<?php

use Kirby\Cms\App;

return function (App $kirby) {
	if ($kirby->option('archived') === true) {
		go('https://getkirby.com/' . $kirby->path());
	}
};
