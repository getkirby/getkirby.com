<?php

use Kirby\Toolkit\Str;

$key = trim(F::read(__DIR__ . '/keys/algolia.txt'));

if (empty($key) === true) {
    // use the search-only API key
    $key = 'd161a2f4cd2d69247c529a3371ad3050';
}

return [
    'areas' => [
        'all'       => 'All pages',
        'guide'     => 'Guide',
        'reference' => 'Reference',
        'cookbook'  => 'Cookbook',
        'plugin'    => 'Plugin',
        'kosmos'    => 'Kosmos'
    ],
    'algolia' => [
        'app'   => 'S7OGBIAJTV',
        'key'   => $key,
        'index' => 'getkirby-3',
        'fields' => [
            'template',
            'title',
            'description' => function ($page) {
                $field = $page->description()->or($page->intro());
                return strip_tags($field->kti());
            },
            'text' => function($page) {
                return strip_tags($page->text()->kti());
            },
            'area' => function ($page) {
                if (Str::startsWith($page->id(), 'docs/reference') === true) {
                    return 'reference';
                }

                switch ($page->intendedTemplate()->name()) {
                    case 'cookbook-recipe':
                        return 'cookbook';
                    case 'guide':
                        return 'guide';
                    case 'kosmos-issue':
                        return 'kosmos';
                    case 'plugin':
                        return 'plugin';
                }
            }
        ],
        'templates' => [
            'cookbook-category',
            'cookbook-recipe',
            'glossary',
            'guide',
            'kosmos-issue',
            'plugin',
            'reference-article',
            'reference-block',
            'reference-class',
            'reference-classmethod',
            'reference-component',
            'reference-endpoint',
            'reference-extension',
            'reference-fieldmethod',
            'reference-helper',
            'reference-hook',
            'reference-icon',
            'reference-kirbytag',
            'reference-panelsection',
            'reference-root',
            'reference-section',
            'reference-ui',
            'reference-url',
            'reference-validator',
            'security',
            'text',
            'release',
            'release-35'
        ]
    ]
];
