<?php

use Kirby\Cms\App;

load([
	'Buy\Paddle'      => __DIR__ . '/Paddle.php',
	'Buy\Passthrough' => __DIR__ . '/Passthrough.php',
	'Buy\Price'       => __DIR__ . '/Price.php',
	'Buy\Product'     => __DIR__ . '/Product.php',
	'Buy\Sale'        => __DIR__ . '/Sale.php',
	'Buy\Upgrade'     => __DIR__ . '/Upgrade.php',
	'Buy\Visitor'     => __DIR__ . '/Visitor.php',
]);

App::plugin('getkirby/buy', []);
