<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/helpers/cdn.php';
require __DIR__ . '/helpers/html.php';
require __DIR__ . '/helpers/reference.php';
require __DIR__ . '/helpers/search.php';

Kirby::plugin('getkirby/site', [
    'cacheTypes'   => include __DIR__ . '/extensions/cacheTypes.php',
    'components'   => include __DIR__ . '/extensions/components.php',
    'fieldMethods' => include __DIR__ . '/extensions/fieldMethods.php',
    'hooks'        => include __DIR__ . '/extensions/hooks.php',
    'pageMethods'  => include __DIR__ . '/extensions/pageMethods.php',
    'pagesMethods' => include __DIR__ . '/extensions/pagesMethods.php',
    'routes'       => include __DIR__ . '/extensions/routes.php',
    'tags'         => include __DIR__ . '/extensions/tags.php',
]);