<?php

define('KIRBY_HELPER_VIDEO', false);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../../../../kirby/bootstrap.php';

// boot the site to load its page models and content
// which are needed to resolve Reference pages
new Kirby\Cms\App([
	'roots' => [
		'index' => dirname(__DIR__, 4)
	]
]);
