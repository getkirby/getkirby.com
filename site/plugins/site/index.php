<?php

use Kirby\Cms\App;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/helpers/html.php';
require_once __DIR__ . '/helpers/markdown.php';
require_once __DIR__ . '/helpers/reference.php';

// make default page model and reference page models available for extension
// TODO: Remove when https://github.com/getkirby/kirby/issues/5968 is implemented
require_once __DIR__ . '/../../models/default.php';
require_once __DIR__ . '/../../models/reference-article.php';
require_once __DIR__ . '/../../models/reference-section.php';

App::plugin('getkirby/site', [
	'components'   => include __DIR__ . '/extensions/components.php',
	'fieldMethods' => include __DIR__ . '/extensions/fieldMethods.php',
	'fileTypes'    => [
		'md' => [
			'type' => 'document',
			'mime' => 'text/markdown',
		],
	],
	'tags' => include __DIR__ . '/extensions/tags.php',
]);
