<?php

return [

    // 'url' => '/',
    'markdown' => [
        'extra' => true,
    ],
    'price' => [
        'eur' => 99,
        'usd' => 115
    ],
    // 'sale' => [
    //     'text' => 'Save 20% per license<br><small class="description" style="font-size: .75rem; font-weight: 400">only until July 12th</small>',
    // ],

    'api'     => false,
    'panel'   => false,
    'debug'   => true,
    'algolia' => require __DIR__ . '/algolia.php',
    'routes'  => require __DIR__ . '/routes.php',
    'github'  => 'https://github.com/getkirby',
    'plugins' => [
        'categories' => [
            'panel'         => ['icon' => 'panel', 'label' => 'Panel'],
            'templating'    => ['icon' => 'html', 'label' => 'Templating'],
            'seo'           => ['icon' => 'seo', 'label' => 'SEO'],
            // 'accessibility' => ['icon' => 'user', 'label' => 'Accessibility'],
            'security'      => ['icon' => 'lock', 'label' => 'Security'],
            'performance'   => ['icon' => 'performance', 'label' => 'Performance'],
            'analytics'     => ['icon' => 'analytics', 'label' => 'Analytics'],
            'assets'        => ['icon' => 'image', 'label' => 'Assets'],
            'text'          => ['icon' => 'text', 'label' => 'Text'],
            'forms'         => ['icon' => 'forms', 'label' => 'Forms'],
            'utilities'     => ['icon' => 'wand', 'label' => 'Utilities'],
            'integrations'  => ['icon' => 'integration', 'label' => 'Integrations'],
            'social'        => ['icon' => 'twitter', 'label' => 'Social Networking']
        ]
    ],

    'kirby.meta.templatesInclude' => [
        'home',
        'buy',
        'news',
        'community',
        'documentation',
        'guide',
        'coookbook',
        'recipe',
        'reference',
        'reference.kirbytags',
        'reference.kirbytag',
        'reference.panelsection',
        'reference.article',
        'reference.section',
        'reference.fieldmethods',
        'reference.fieldmethod',
        'reference.classmethod',
        'reference.class',
        'reference.urls',
        'reference.url',
        'reference.roots',
        'reference.root',
        'reference.validators',
        'reference.validator',
        'reference.extensions',
        'reference.extension',
        'reference.hooks',
        'reference.hook',
        'reference.component',
        'reference.endpoints',
        'reference.endpoint',
        'glossary',
        'archive',
        'contact',
        'kosmos',
        'issue',
        'text',
        'cases',
        'plugins',
        'press',
        'search',
        'styleguide',
        'try',
        'release',
        'why',
    ],
    'kirby.meta.pagesInclude' => [
    ],
    'kirby.meta.pagesExclude' => [
        'docs/reference/@/.*',
    ],
    'cache' => [
        'pages' => [
            'active' => false,
            'type'   => 'apcu'
        ],
        'plugins' => [
            'active' => true,
            'type'   => 'file'
        ]
    ],
];
