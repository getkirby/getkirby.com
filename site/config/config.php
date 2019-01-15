<?php

return [

    'url' => '/',
    'markdown' => [
        'extra' => true,
    ],
    'price' => [
        'eur' => 99,
        'usd' => 115
    ],
    'sale' => [
        'text' => 'Save €10 per license<br> with our Kirby 3 launch price!<br><small class="description" style="font-size: .75rem; font-weight: 400">only until January 29th</small>',
        'eur' => 89,
        'usd' => 105
    ],

    'api'     => false,
    'panel'   => false,
    'debug'   => true,
    'algolia' => require __DIR__ . '/algolia.php',
    'routes'  => require __DIR__ . '/routes.php',
    'github'  => 'https://github.com/k-next',

    'cheatsheet' => [
        'Text' => [
            'markdown',
            'kirbytags',
        ],
        'Templates' => [
            'field-methods',
            'helpers',
        ],
        'Panel' => [
            'blueprints',
            'presets',
            'fields',
            'sections',
            'icons',
            'samples',
        ],
        'Objects' => [
            'file',
            'files',
            'kirby',
            'language',
            'languages',
            'page',
            'pages',
            'pagination',
            'request',
            'session',
            'site',
            'user',
            'users'
        ],
        'Router' => [
            'router/patterns',
            'router/responses'
        ],
        'System' => [
            'options',
            'urls',
            'roots',
            'validators'
        ],
        'Plugins' => [
            'extensions',
            'hooks',
            'components',
            'ui',
        ],
        'API' => [
            'api/auth',
            'api/languages',
            'api/pages',
            'api/roles',
            'api/site',
            'api/system',
            'api/translations',
            'api/users',
        ],
        'Tools' => [
            'a',
            'cookie',
            'data',
            'dir',
            'escape',
            'f',
            'html',
            'header',
            'mime',
            'server',
            'str',
            'url',
            'xml'
        ],
    ],

    'cloudinary' => [
        'domain' => 'https://nnnnext.getkirby.com',
    ],

];
