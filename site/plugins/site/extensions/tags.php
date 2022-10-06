<?php

use Kirby\Cms\Section;
use Kirby\Form\Field;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\Tpl;
use Kirby\Reference\DocBlock;
use Kirby\Reference\Types;

$tags = [];

/**
 * (snippet: snippet/to/render/the/children)
 */
$tags['snippet'] = [
    'html' => function ($tag) {
        return snippet($tag->value(), [], true);
    }
];

/**
 * (icon: icon-name)
 */
$tags['icon'] = [
    'html' => function ($tag) {
        return '<svg width="16" height="16"><use href="#icon-' . $tag->value() . '" /></svg>';
    }
];

/**
 * (image: my-screenshot.jpg)
 */
$tags['image'] = [
    'attr' => [
        'caption',
        'link',
        'title',
        'class'
    ],
    'html' => function ($tag) {
        if ($file = $tag->file($tag->value)) {
            return snippet('kirbytext/image', [
                'file'    => $file,
                'class'   => $tag->class,
                'link'    => empty($tag->link) ? null : ($tag->link === 'self' ? $file->url() : $tag->link),
                'caption' => $tag->caption ?? $file->caption()->value()
            ], true);
        }
    }
];

/**
 * (screencast: https://www.youtube.com/watch?v=EDVYjxWMecc title: How to install Kirby in 5 minutes)
 */
$tags['screencast'] = [
    'attr' => [
        'title',
        'text',
    ],
    'html' => function ($tag) {
        return snippet('kirbytext/screencast', [
            'url'   => $tag->value,
            'title' => $tag->title ?? null,
            'text'  => $tag->text ?? null
        ], true);
    }
];

/**
 * (glossary: panel)
 */
$tags['glossary'] = [
    'attr' => ['text'],
    'html' => function ($tag) {
        if ($term = page('docs/glossary/' . $tag->value)) {
            $title = $term->entry()->stripGlossary()->kti();

            return '<abbr title="' . Str::unhtml($title) . '"><a href="' . $term->parent()->url() . '/#' . $term->slug() . '">' . ($tag->text ?? $term->title()) . '</a></abbr>';
        }
    }
];

/**
 * (reference: templates/field-methods)
 * Renders a grid of all children of the reference page
 */
$tags['reference'] = [
    'html' => function ($tag) {
        if ($page = page('docs/reference/' . $tag->value())) {
            return snippet('kirbytext/reference', [
                'entries' => $page->children()->listed()
            ], true);
        }
    }
];

/**
 * Used to render automatic $props array table
 */
$tags['properties'] = [
    'attr' => [
        'class',
        'title',
        'intro',
        'rows',
        'additional'
    ],
    'html' => function ($tag) {
        $name = $tag->value ?? '$props';

        if ($tag->class) {
            $page = ReferenceClassPage::findByName($tag->class);
        } else {
            $page = $tag->parent();
        }

        $rows = $tag->attr('rows') ?? $page->properties();

        if ($additional = $tag->attr('additional')) {
            $rows = array_merge($rows, $additional);
            array_multisort(array_column($rows, 'name'), SORT_ASC, $rows);
        }

        if ($page) {
            return snippet('templates/reference/entry/parameters', [
                'title'    => $tag->title ?? false,
                'intro'    => $tag->intro ?? false,
                'rows'     => $rows,
                'defaults' => false
            ], true);
        }
    }
];

/**
 * Used for replacing nested glossary tags
 */
$tags['plain'] = [
    'attr' => ['text'],
    'html' => function ($tag) {
        return $tag->text ?? $tag->value;
    }
];

/**
* (docs: some-snippet)
* Injects shared doc snippets from site/snippets/docs
*/
$tags['docs'] = [
    'attr' => [
        'field',
        'vars'
    ],
    'html' => function ($tag) {
        parse_str($tag->attr('vars', ''), $vars);

        $data = array_merge([
            'page'  => $tag->parent(),
            'field' => $tag->attr('field')
        ], $vars);

        $snippet = snippet('docs/' . $tag->value, $data, true);

        return kirbytext($snippet, [
            'parent' => $tag->parent()
        ]);
    }
];


/**
 * Enhanced link tag with support for automatic
 * linking to Reference pages
 */
$tags['class'] = $tags['method'] = [
    'attr' => [
        'method',
        'text'
    ],
    'html' => function ($tag) {
        $type = $tag->value;
        $text = $tag->attr('text');

        // (class: foo method: bar)
        if ($tag->attr('class') && $tag->attr('method')) {
            $type .= '::' . $tag->attr('method');

            if ($text === null) {
                $parts = Str::split($tag->attr('class'), '\\');
                $name  = array_pop($parts);
                $text = $name . '->' . $tag->attr('method') . '()';
            }
        }

        return Types::format($type, true, trim($text));
    }
];

$tags['helper'] = [

    'html' => function ($tag) {
        return kirbytag('method', 'Helper::' . $tag->value, ['text' => $tag->value . '()']);
    }
];


// @todo All the following should be refactored, but this requires
// content file changes, so we wait

/**
 * Fetch prop definitions from Fields and Sections
 * and create an options table for it.
 *
 * @param array $definition
 * @return array
 * @todo refactor/deprecate
 */
function toOptions(array $props) {

    $table = [];

    foreach ($props as $attr => $prop) {

        if ($attr === 'value') {
            continue;
        }

        if (is_callable($prop) === false) {
            continue;
        }

        $reflection = new ReflectionFunction($prop);
        $parameter  = $reflection->getParameters()[0] ?? null;
        $comment    = null;

        try {
            $default = $parameter->getDefaultValue();
        } catch (Exception $e) {
            $default = null;
        }

        if ($docComment = $reflection->getDocComment()) {
            try {
                $docBlock = new DocBlock($docComment);
                $comment  = trim($docBlock->getSummary());
                $comment  = str_replace(PHP_EOL, ' ', $comment);

                if ($comment === '/') {
                    $comment = null;
                }

            } catch (Throwable $e) {
            }
        }

        if (is_array($default) === true) {
            $default = '[]';
        }

        if ($default === true) {
            $default = 'true';
        }

        if ($default === false) {
            $default = 'false';
        }

        $table[$attr] = [
            'name'        => $attr,
            'required'    => $parameter->isOptional() !== true,
            'type'        => $parameter->getType() ? $parameter->getType()->getName() : null,
            'default'     => $default,
            'description' => $comment,
        ];

    }

    ksort($table);

    return $table;

}

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

$tags['field-options'] = [
    'html' => function ($tag) {
        $type       = $tag->value;
        $definition = Field::setup($type);
        $props      = $definition['props'] ?? [];
        $table      = toOptions($props);

        return snippet('templates/reference/entry/parameters', [
            'title' => false,
            'rows'  => $table
        ], true);
    }
];

$tags['section-options'] = [
    'html' => function ($tag) {
        $type       = $tag->value;
        $definition = Section::setup($type);
        $props      = $definition['props'] ?? [];
        $table      = toOptions($props);

        return snippet('templates/reference/entry/parameters', [
            'title' => false,
            'rows' => $table
        ], true);
    }
];

return $tags;
