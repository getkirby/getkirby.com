<?php

use Kirby\Cms\App;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/helpers/html.php';
require_once __DIR__ . '/helpers/reference.php';

// make default page model available for extension
// TODO: Remove when https://github.com/getkirby/kirby/issues/5968 is implemented
require_once __DIR__ . '/../../models/default.php';

App::plugin('getkirby/site', [
	'components'   => include __DIR__ . '/extensions/components.php',
	'fieldMethods' => include __DIR__ . '/extensions/fieldMethods.php',
	'tags'         => include __DIR__ . '/extensions/tags.php'
]);
