<?php

header('X-Frame-Options: sameorigin');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

return [
    'api'       => false,
    'banners'   => require __DIR__ . '/banners.php',
    'debug'     => true,
    'github'    => require __DIR__ . '/github.php',
    'features'  => require __DIR__ . '/features.php',
    'meta'      => require __DIR__ . '/meta.php',
    'newstroll' => require __DIR__ . '/newstroll.php',
    'paddle'    => require __DIR__ . '/paddle.php',
    'panel'     => false,
    'plugins'   => require __DIR__ . '/plugins.php',
    'routes'    => require __DIR__ . '/routes.php',
    'search'    => require __DIR__ . '/search.php',
    'hub'       => require __DIR__ . '/hub.php',
    'thumbs'    => [
        'driver' => 'im'
    ],
];
