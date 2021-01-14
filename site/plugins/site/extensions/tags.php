<?php

use Kirby\Cms\Section;
use Kirby\Form\Field;
use Kirby\Toolkit\Str;


$tags = [];

/**
 * (api-fields: user)
 * @todo find a better name
 */
$tags['api-fields'] = [
    'html' => function ($tag) {
        $models = $tag->kirby()->api()->models();
        $model  = $models[$tag->value] ?? [];
        $fields = array_keys($model['fields'] ?? []);

        if (empty($fields) === true) {
            return '';
        }

        $fields = array_map(function ($field) {
            return '`' . $field . '`';
        }, $fields);

        return '- ' . implode(PHP_EOL . '- ', $fields);
    }
];


/**
 * (btn: some/link text: Button text icon: download)
 */
$tags['btn'] = $tags['cta'] = [
    'attr' => [
        'text',
        'icon'
    ],
    'html' => function ($tag) {
        return snippet('cta', [
            'link'  => $tag->value,
            'text'  => $tag->text,
            'icon'  => $tag->icon
        ], true);
    }
];

/**
 * (docs: some-snippet)
 *
 * Injects shared doc snippets
 * from snippets/docs/snippets
 */
$tags['docs'] = [
    'attr' => [
        'field'
    ],
    'html' => function ($tag) {
        $snippet = snippet('docs/' . $tag->value, [
            'page'  => $tag->parent(),
            'field' => $tag->attr('field')
        ], true);

        return kirbytext($snippet, [
            'parent' => $tag->parent()
        ]);
    }
];


/**
 * @todo deprecate
 */
$tags['field-options'] = [
    'html' => function ($tag) {
        $type       = $tag->value;
        $definition = Field::setup($type);
        $props      = $definition['props'] ?? [];
        $table      = componentOptions($props);

        return snippet('field-options', ['rows' => $table], true);
    }
];

$tags['glossary'] = [
    'attr' => [
        'text'
    ],
    'html' => function ($tag) {
        if ($glossary = page('docs/glossary/' . $tag->value)) {
            return
                '<mark class="glossary">' .
                    '<a href="' . $glossary->url() . '">' . $tag->attr('text', $glossary->title()) . '</a>' .
                '</mark>';
        }
    }
];

/**
 * @todo deprecate
 */
$tags['pages'] = [
    'html' => function ($tag) {
        $pages = Str::query($tag->value, [
            'page' => $tag->parent(),
            'site' => site(),
        ]);

        return snippet('pages', ['pages' => $pages], true);
    }
];

/**
 * Images get auto-resized
 */
$tags['picture'] = $tags['screenshot'] = [
    'attr' => [
        'alt',
        'caption',
        'link'
    ],
    'html' => function ($tag) {
        if ($image = $tag->file($tag->value())) {
            return snippet('prose/image', [
                'image'   => $image,
                'alt'     => $tag->alt(),
                'caption' => $tag->caption(),
                'link'    => $tag->link()
            ], true);
        }
    }
];

/**
 * @todo deprecate
 */
$tags['reference'] = [
    'html' => function ($tag) {
        if ($page = page('docs/reference/' . $tag->value())) {
            return snippet('cheatsheet', ['methods' => $page->children()->listed()], true);
        }
    }
];

/**
 * @todo deprecate
 */
$tags['section-options'] = [
    'html' => function ($tag) {
        $type       = $tag->value;
        $definition = Section::setup($type);
        $props      = $definition['props'] ?? [];
        $table      = componentOptions($props);

        return snippet('field-options', ['rows' => $table], true);
    }
];


return $tags;
