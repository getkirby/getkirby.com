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
    //     'text' => 'Save 20% per license<br><small class="description" style="font-size: .75rem; font-weight: 400">only until December 22nd</small>',
    //     'banner' => 'Save <strong>20% per license</strong> until December 22nd'
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
        'community',
        'guide',
        'coookbook',
        'cookbook-recipe',
        'reference',
        'reference-kirbytags',
        'reference-kirbytag',
        'reference-section',
        'reference-article',
        'reference-fieldmethods',
        'reference-fieldmethod',
        'reference-classmethod',
        'reference-class',
        'reference-urls',
        'reference-url',
        'reference-roots',
        'reference-root',
        'reference-validators',
        'reference-validator',
        'reference-extensions',
        'reference-extension',
        'reference-hooks',
        'reference-hook',
        'reference-component',
        'reference-endpoints',
        'reference-endpoint',
        'glossary',
        'archive',
        'contact',
        'kosmos',
        'kosmos-issue',
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
