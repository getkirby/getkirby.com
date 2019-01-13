<?php

$key = trim(F::read(__DIR__ . '/keys/algolia.txt') ?? 'd161a2f4cd2d69247c529a3371ad3050');

return [
    'app'    => 'S7OGBIAJTV',
    'key'    => $key,
    'index'  => 'getkirby-3',
    'fields' => [
        'url',
        'template',
        'title',
        'description' => function ($page) {
            return strip_tags($page->description()->kt());
        },
        'excerpt' => function ($page) {
            return strip_tags($page->excerpt()->kt());
        },
        'text' => function($page) {
            return strip_tags($page->text()->kt());
        },
        'area' => function ($page) {
            if (Str::startsWith($page->id(), 'docs/reference') === true) {
                return 'reference';
            }

            switch ($page->template()->name()) {
                case 'recipe':
                    return 'cookbook';
                case 'guide':
                    return 'guide';
                case 'issue':
                    return 'kosmos';
            }

        }
    ],
    'templates' => [
        'cheatsheet-article',
        'cheatsheet-section',
        'class',
        'component',
        'contact',
        'endpoint',
        'field-method',
        'glossary-entry',
        'guide',
        'helper',
        'hook',
        'icon',
        'issue',
        'kirbytag',
        'method' => [
            'filter' => function ($page) {
                return $page->isListed() === true;
            }
        ],
        'recipe',
        'root',
        'text',
        'url',
        'validator',
    ]
];
