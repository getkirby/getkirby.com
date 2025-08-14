<?php

return [
	'api'        => false,
	'archived'   => true,
	'buy'        => require __DIR__ . '/buy.php',
	'categories' => require __DIR__ . '/categories.php',
	'debug'      => false,
	'features'   => require __DIR__ . '/features.php',
	'github'     => ['url' => 'https://github.com/getkirby'],
	'hub'        => ['url' => 'https://hub.getkirby.com'],
	'keys'       => file_exists(__DIR__ . '/keys.php') ? require __DIR__ . '/keys.php' : require __DIR__ . '/keys.sample.php',
	'meta'       => require __DIR__ . '/meta.php',
	'newstroll'  => ['list' => 110866],
	'panel'      => false,
	'cookbook'   => require __DIR__ . '/cookbook.php',
	'routes'     => require __DIR__ . '/routes.php',
	'search'     => require __DIR__ . '/search.php',
	'thumbs'     => [
		// 'driver' => 'im'
	],
	'versions'   => require __DIR__ . '/versions.php',
	'content' => [
		'locking' => false,
		'uuid'    => false
	],
];
