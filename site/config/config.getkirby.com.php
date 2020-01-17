<?php

return [
    'debug' => false,
    'cache' => [
        'pages' => [
            'active' => true,
            'type'   => 'apcu'
        ],
        'plugins' => [
            'active' => true,
            'type'   => 'apcu'
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
