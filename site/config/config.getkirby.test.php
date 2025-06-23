<?php

return [
	'cache' => [
		'github' => [
			'active' => true,
			'type'   => 'file'
		],
	],
	'debug' => true,
	'email' => [
		'transport' => [
			'type'     => 'smtp',
			'host'     => 'localhost',
			'port'     => 1025,
			'security' => false
		]
	],
	'thumbs' => [
		'driver' => 'im',
		'bin' => '/opt/homebrew/bin/convert'
	],
	'hub' => [
		'url' => 'https://hub.getkirby.test'
	],
];
