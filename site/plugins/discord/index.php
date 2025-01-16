<?php

use Kirby\Cms\App;

load([
	'kirby\\discord\\author'  => __DIR__ . '/src/Author.php',
	'kirby\\discord\\discord' => __DIR__ . '/src/Discord.php',
	'kirby\\discord\\field'   => __DIR__ . '/src/Field.php'
]);

App::plugin('getkirby/discord', []);
