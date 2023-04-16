<?php

return function ($kirby) {
	if (option('archived') === true) {
		go('https://getkirby.com/' . $kirby->path());
	}
};
