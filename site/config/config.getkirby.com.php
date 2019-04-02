<?php

return [
    'beta'  => false,
    'debug' => false,
    'cache' => [
        'pages' => [
            'active' => true,
            'type' => 'apcu'
        ]
    ],
    'cachebuster' => [
        'mode' => 'path'
    ],
    'cloudinary' => true,
    'keycdn' => [
        'domain' => 'https://assets.getkirby.com',
    ]
];
