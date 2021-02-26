<?php

use Kirby\Meta\PageMeta;
use Kirby\Meta\SiteMeta;

require __DIR__ . '/vendor/autoload.php';

Kirby::plugin('kirby/meta', [

    'options' => [
        'templatesInclude' => [],
        'pagesInclude' => [],
        'pagesExclude' => [],
    ],

    'routes' => [
        [
            'pattern' => 'robots.txt',
            'method' => 'ALL',
            'action' => function () {
                return SiteMeta::robots();
            },
        ],
        [
            'pattern' => 'sitemap.xml',
            'action' => function () {
                return SiteMeta::sitemap();
            }
        ],
        [
            'pattern' => 'open-search.xml',
            'action' => function () {
                return SiteMeta::search();
            },
        ]
    ],
    'pageMethods' => [
        'meta' => function () {
            return new PageMeta($this);
        },
    ]
]);
