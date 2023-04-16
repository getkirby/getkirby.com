<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/helpers/banner.php';
require __DIR__ . '/helpers/html.php';
require __DIR__ . '/helpers/reference.php';

class_alias('Kirby\\Reference\\Types', 'Types');

Kirby::plugin('getkirby/site', [
	'components'   => include __DIR__ . '/extensions/components.php',
	'fieldMethods' => include __DIR__ . '/extensions/fieldMethods.php',
	'tags'         => include __DIR__ . '/extensions/tags.php'
]);
