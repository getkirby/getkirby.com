<?php

use PHPMailer\PHPMailer\PHPMailer;

return [
	'cache' => require __DIR__ . '/cache.php',
	'cdn' => [
		'domain' => 'https://assets.getkirby.com',
	],
	'email' => [
		'transport' => [
			'type'     => 'smtp',
			'host'     => 'smtps-proxy.fastmail.com',
			'port'     => 443,
			'security' => PHPMailer::ENCRYPTION_SMTPS,
			'auth'     => true,
			'username' => 'mail@getkirby.com',
			'password' => (require __DIR__ . '/keys.php')['fastmail'],
		]
	],
	'partnerhub' => [
		'url'        => 'https://partners.getkirby.com/partners.json',
		'partnerUrl' => 'https://partners.getkirby.com/partners/'
	
	]
];
