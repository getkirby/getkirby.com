<?php

return [
    'beta'  => false,
    'debug' => false,
    'cache' => [
        'pages' => [
            'active' => true,
            'type' => 'compressor'
        ]
    ],
    'cachebuster' => [
        'mode' => 'path'
    ],
    'cloudinary' => [
        'domain' => 'https://getkirby.com',
    ],
    'keycdn' => [
        'domain' => 'https://assets.getkirby.com',
    ]
];
