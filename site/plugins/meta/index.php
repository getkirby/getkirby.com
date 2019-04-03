<?php

use Kirby\Meta\PageMeta;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helpers.php';

Kirby::plugin('kirby/meta', [
    'routes' => [
        [
            'pattern' => 'meta-debug',
            'action' => function() {
                return Page::factory([
                    'slug' => 'meta-debug',
                    'template' => 'meta-debug',
                    'model' => 'meta-debug',
                    'content' => [
                        'title' => 'Metadata debug',
                    ]
                ]);
            },
        ],
        // [
        //     'pattern' => 'sitemap.xml',
        //     'action' => function() {
        //         return Page::factory([
        //             'slug' => 'sitemap',
        //             'template' => 'xml-sitemap',
        //         ]);
        //     }
        // ]
    ],

    'pageMethods' => [
        'meta' => function() {
            return new PageMeta($this);
        }
    ],

    'pageModels' => [
        'meta-debug' => 'Kirby\\Meta\\Models\\MetaDebugPage',
    ],

    'templates' => [
        'meta-debug' => __DIR__ . '/templates/meta-debug.php',
        // 'xml-sitemap' => __DIR__ . '/templates/xml-sitemap.php',
    ]
]);
