<?php

use Kirby\Filesystem\F;
use Kirby\Toolkit\Str;

$key = trim(F::read(__DIR__ . '/keys/algolia.txt'));

if (empty($key) === true) {
    // use the search-only API key
    $key = 'd161a2f4cd2d69247c529a3371ad3050';
}

return [
    'algolia' => [
        'app'   => 'S7OGBIAJTV',
        'key'   => $key,
        'index' => 'getkirby-3',
        'fields' => [
            'title' =>
                fn ($page) => $page->searchtitle()->or($page->title()),
            'byline' =>
                fn ($page) => strip_tags($page->searchbyline()->kti()),
            'intro' => function ($page) {
                $html = $page->description()->or($page->intro())->kti();
                return strip_tags($html);
            },
            'area' => function ($page) {
                if (Str::startsWith($page->id(), 'docs/reference') === true) {
                    return 'reference';
                }

                return match ($page->intendedTemplate()->name()) {
                    'cookbook-recipe' => 'cookbook',
                    'guide'           => 'guide',
                    'kosmos-issue'    => 'kosmos',
                    'plugin'          => 'plugin',
                    default           => null
                };
            },
            'weight' => function ($page) {
                return match ($page->intendedTemplate()->name()) {
                    'guide',
                    'cookbook-recipe'        => 2,
                    'reference-classmethod',
                    'reference-component',
                    'reference-endpoint',
                    'reference-fieldmethod',
                    'reference-helper',
                    'reference-hook',
                    'reference-kirbytag',
                    'reference-validator'    => 0.5,
                    'referece-icon',
                    'reference-root',
                    'reference-url'          => 0.25,
                    default                  => 1
                };
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
            'reference-validators',
            'security',
            'text',
            'release',
            'release-35'
        ]
    ],
    'areas' => [
        'all'       => 'All pages',
        'guide'     => 'Guide',
        'reference' => 'Reference',
        'cookbook'  => 'Cookbook',
        'plugin'    => 'Plugin',
        'kosmos'    => 'Kosmos'
    ],
];
