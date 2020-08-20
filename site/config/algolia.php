<?php

$key = trim(F::read(__DIR__ . '/keys/algolia.txt'));

if (empty($key)) {
    $key = 'd161a2f4cd2d69247c529a3371ad3050';
}

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
                case 'plugin':
                    return 'plugin';
            }

        }
    ],
    'templates' => [
        'reference.article',
        'reference.section',
        'class' => [
            'filter' => function ($page) {
                return $page->isListed() === true;
            }
        ],
        'reference.component',
        'contact',
        'reference.endpoint',
        'reference.extension',
        'reference.fieldmethod',
        'guide',
        'reference.helper',
        'reference.hook',
        'reference.icon',
        'issue',
        'reference.kirbytag',
        'reference.classmethod' => [
            'filter' => function ($page) {
                return $page->isListed() === true &&
                       $page->parent()->isListed() === true;
            }
        ],
        'plugin',
        'recipe',
        'release',
        'root',
        'reference.panelsection',
        'text',
        'reference.url',
        'reference.validator',
    ]
];
