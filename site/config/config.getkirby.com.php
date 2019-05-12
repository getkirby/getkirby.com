<?php

return [
    'debug' => true,
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
