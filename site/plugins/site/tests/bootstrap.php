<?php

define('KIRBY_HELPER_VIDEO', false);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../../../../kirby/bootstrap.php';

// boot the actual site, so that tests can rely on
// the page models, the core extensions and the options
new Kirby\Cms\App([
	'roots' => [
		'index' => __DIR__ . '/../../../..'
	]
]);
