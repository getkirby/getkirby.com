<?php

return [
	'cache'     => [
		'github' => [
			'active' => true,
			'type'   => 'file'
		],
	],
	'debug'     => true,
	'email'     => [
		'transport' => [
			'type'     => 'smtp',
			'host'     => 'localhost',
			'port'     => 1025,
			'security' => false
		]
	],
	'thumbs'    => [
		'driver' => 'imagick',
		// 'bin' => '/usr/local/bin/convert'
	],
	'hub'       => [
		'url' => 'https://hub.getkirby.test'
	],
	'partners'  => [
		'url'        => 'http://partners.test/profiles.json',
		'partnerUrl' => 'http://partners.test/profiles/',
		'signupUrl'  => 'http://partners.test/signup'

	],
	'kosmosApi' => 'http://kosmos.test/kosmos.json',
];
