<?php

use Kirby\Toolkit\Str;

return [
    'loupe' => [
        // Database path (directory, not file)
        'database_path'         => 'site/config/loupe',

        // Primary key
        'primary_key'           => 'objectID',

        // Searchable attributes for Loupe
        'searchable_attributes' => [
            'title',
            'intro',
            'text',
            'keywords',
            'byline'
        ],

        // Filterable attributes (for advanced search)
        'filterable_attributes' => [
            'area',
            'template',
            'weight'
        ],

        // Sortable attributes
        'sortable_attributes'   => [
            'title',
            'weight'
        ],

        // Fields to index with custom processing
        'fields'                => [
            'title',
            'keywords',

            // Custom field processing with closures
            'byline' => fn($page) => strip_tags($page->searchbyline()->kti()),

            'intro' => function ($page) {
                $html = $page->description()->or($page->intro())->kti();
                return strip_tags($html);
            },

            'text'     => function ($page) {
                return strip_tags($page->text()->kti());
            },

            // Area classification for filtering
            'area'     => function ($page) {
                if (Str::startsWith($page->id(), 'docs/reference') === true) {
                    return 'reference';
                }

                return match ($page->intendedTemplate()->name()) {
                    'cookbook-recipe' => 'cookbook',
                    'guide'           => 'guide',
                    default           => 'general'
                };
            },

            // Relevance weight for ranking
            'weight'   => function ($page) {
                return match ($page->intendedTemplate()->name()) {
                    'guide',
                    'cookbook-recipe'     => 2,
                    'reference-classmethod',
                    'reference-component',
                    'reference-endpoint',
                    'reference-fieldmethod',
                    'reference-helper',
                    'reference-hook',
                    'reference-kirbytag',
                    'reference-validator' => 0.5,
                    'reference-icon',
                    'reference-root',
                    'reference-url'       => 0.25,
                    default               => 1
                };
            },

            // Template name for filtering
            'template' => function ($page) {
                return $page->intendedTemplate()->name();
            }
        ],

        // Templates to include in search index
        'templates'             => [
            'cookbook-category',
            'cookbook-recipe',
            'glossary',
            'guide',
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
        'cookbook'  => 'Cookbook'
    ],
];
