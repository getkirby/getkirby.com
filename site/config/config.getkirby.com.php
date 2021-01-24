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
    'keycdn' => [
        'domain' => 'https://assets.getkirby.com',
    ],
    'referenceLookup' => true
];
