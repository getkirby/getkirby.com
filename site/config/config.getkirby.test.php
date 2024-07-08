<?php

return [
	'cache' => [
		'meet' => [
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
		// 'bin' => '/usr/local/bin/convert'
	],
	'hub' => [
		'url' => 'https://hub.getkirby.test'
	],
];
