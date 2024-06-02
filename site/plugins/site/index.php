<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/helpers/html.php';
require __DIR__ . '/helpers/reference.php';

// make default page model available for extension
// TODO: Remove when https://github.com/getkirby/kirby/issues/5968 is implemented
require __DIR__ . '/../../models/default.php';

class_alias('Kirby\\Reference\\Types', 'Types');

Kirby::plugin('getkirby/site', [
	'components'   => include __DIR__ . '/extensions/components.php',
	'fieldMethods' => include __DIR__ . '/extensions/fieldMethods.php',
	'tags'         => include __DIR__ . '/extensions/tags.php'
]);
