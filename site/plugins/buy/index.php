<?php

use Kirby\Cms\App;

load([
	'Buy\Price'   => __DIR__ . '/Price.php',
	'Buy\Product' => __DIR__ . '/Product.php',
	'Buy\Upgrade' => __DIR__ . '/Upgrade.php',
]);

App::plugin('getkirby/buy', []);
