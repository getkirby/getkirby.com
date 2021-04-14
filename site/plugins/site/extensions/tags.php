<?php

use Kirby\Cms\Section;
use Kirby\Form\Field;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\Tpl;
use Kirby\Reference\DocBlock;

$tags = [];

/**
 * For editors
 */

 /**
  * @todo: refactor content files to only use (image: )
  */
$tags['image'] = $tags['picture'] = $tags['screenshot'] = [
    'attr' => [
        'caption',
        'link',
        'title',
    ],
    'html' => function ($tag) {
        if ($file = $tag->file($tag->value)) {
            return snippet('kirbytext/image', [
                'file' => $file,
                'link' => empty($tag->link) ? null : ($tag->link === 'self' ? $file->url() : $tag->link),
                'caption' => $tag->caption ?? $file->caption()->value()
            ], true);
        }
    }
];

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

$tags['glossary'] = [
    'attr' => ['text'],
    'html' => function ($tag) {
        if ($term = page('docs/glossary/' . $tag->value)) {
            $title = $term->entry()->stripGlossary()->kti();

            return '<abbr title="' . Str::unhtml($title) . '"><a href="' . $term->parent()->url() . '/#' . $term->slug() . '">' . ($tag->text ?? $term->title()) . '</a></abbr>';
        }
    }
];

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
 * For internal usage
 */

$tags['properties'] = [
    'attr' => [
        'class',
        'title',
        'intro'
    ],
    'html' => function ($tag) {
        $name = $tag->value ?? '$props';

        if ($tag->class) {
            $page = ReferenceClassPage::findByName($tag->class);
        } else {
            $page = $tag->parent();
        }

        if ($page) {
            return snippet('templates/reference/entry/parameters', [
                'title'    => $tag->title ?? false,
                'intro'    => $tag->intro ?? false,
                'rows'     => $page->properties(),
                'defaults' => false
            ], true);
        }
    }
];


$tags['plain'] = [
    'attr' => ['text'],
    'html' => function ($tag) {
        return $tag->text ?? $tag->value;
    }
];

/**
* (docs: some-snippet)
*
* Injects shared doc snippets rom site/docs
*/
$tags['docs'] = [
    'attr' => [
        'field'
    ],
    'html' => function ($tag) {
        $file = $tag->kirby()->root('site') . '/docs/' . $tag->value . '.php';

        if (file_exists($file) === false) {
            return;
        }

        $snippet = Tpl::load($file, [
            'page'  => $tag->parent(),
            'field' => $tag->attr('field')
        ]);

        return kirbytext($snippet, [
            'parent' => $tag->parent()
        ]);
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
function componentOptions(array $props) {

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
        $table      = componentOptions($props);

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
        $table      = componentOptions($props);

        return snippet('templates/reference/entry/parameters', [
            'title' => false,
            'rows' => $table
        ], true);
    }
];

return $tags;
