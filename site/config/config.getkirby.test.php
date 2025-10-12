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
		// 'bin' => '/usr/local/bin/convert'
	],
	'hub' => [
		'url' => 'https://hub.getkirby.test'
	],
	'partnerhub' => [
		'url' => 'http://partners.test/partners.json',
	]
];
