<?php

return [
	'products' => [
		'basic' => [
			'product' => 824338,
			'nudge'   => 59,
			'regular' => 99,
		],
		'enterprise' => [
			'product' => 824340,
			'nudge'   => 249,
			'regular' => 349,
		],
		'partner-certified' => [
			'product' => 822284,
			'regular' => 499,
		],
		'partner-regular' => [
			'product' => 824333,
			'regular' => 99,
		],
	],
	'pppFactors' => (@include __DIR__ . '/buy.ppp.php') ?: [],
	'revenueLimit' => 1000000,
	'sale' => [
		'start'    => '2025-12-08',
		'end'      => '2025-12-22',
		'discount' => 20
	],
	'quantities' => [
		'min' => 1,
		'max' => 20,
	],
	'volume' => [
		5  => 5,
		10 => 10,
		15 => 15
	],
	'donation' => [
		'teamAmount'     => 1,
		'customerAmount' => 1,
		'charity' => 'Future Cleantech Architects',
		'purpose' => 'to close the remaining innovation gaps to reach net-zero emissions by 2050.',
		'link'    => 'https://fcarchitects.org'
	]
];
