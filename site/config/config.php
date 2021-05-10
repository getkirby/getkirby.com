<?php

return [
    'api'      => false,
    'banner'   => require __DIR__ . '/banner.php',
    'debug'    => true,
    'github'   => require __DIR__ . '/github.php',
    'features' => require __DIR__ . '/features.php',
    'meta'     => require __DIR__ . '/meta.php',
    'panel'    => false,
    'plugins'  => require __DIR__ . '/plugins.php',
    'routes'   => require __DIR__ . '/routes.php',
    'search'   => require __DIR__ . '/search.php',
    'thumbs'   => [
        'driver' => 'im'
    ]
];
