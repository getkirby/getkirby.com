<?php

use Buy\RevenueLimit;
use Kirby\Cms\App;

@include_once __DIR__ . '/vendor/autoload.php';

App::plugin('getkirby/buy', [
	'options' => [
		'cache' => true
	],
	'tags' => [
		'revenue-limit' => [
			'html' => function ($tag) {
				return RevenueLimit::approximation(null, $tag->value === 'verbose');
			}
		]
	]
]);
