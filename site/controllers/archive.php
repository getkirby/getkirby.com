<?php

use Kirby\Cms\App;

return function (App $kirby) {
	return [
		'versions' => array_filter(
			$kirby->option('versions'),
			fn ($item) => $item['hasDocs'] ?? null === true
		)
	];
};
