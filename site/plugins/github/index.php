<?php

use Kirby\Cms\App;

load([
	'kirby\\github\\github'  => __DIR__ . '/Github.php'
]);

App::plugin('kirby/github', []);
