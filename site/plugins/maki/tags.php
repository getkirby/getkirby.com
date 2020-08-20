<?php

use Kirby\Cms\Html;
use Kirby\Cms\Section;
use Kirby\Cms\Url;
use Kirby\Site\DocBlock;
use Kirby\Form\Field;
use Kirby\Maki\Glossary;

/**
 * Fetch prop definitions from Fields and Sections
 * and create an options table for it.
 *
 * @param array $definition
 * @return array
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
                $comment  = str_replace(PHP_EOL, ' ', $excerpt);

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
            'prop'     => $attr,
            'required' => $parameter->isOptional() !== true,
            'type'     => $parameter->getType() ? $parameter->getType()->getName() : null,
            'default'  => $default,
            'comment'  => $comment,
        ];

    }

    ksort($table);

    return $table;

}

return [

    // API FIELDS TABLE
    'api-fields' => [
        'html' => function ($tag) {
            $fields = array_keys($tag->kirby()->api()->models()[$tag->value]['fields'] ?? []);

            if (empty($fields) === true) {
                return '';
            }

            $fields = array_map(function ($field) {
                return '`' . $field . '`';
            }, $fields);

            return '- ' . implode(PHP_EOL . '- ', $fields);
        }
    ],

    // ARROW LINK
    'arrow-link' => [
        'attr' => [
            'text',
            'direction',
        ],
        'html' => function ($tag) {
            return snippet('arrow-link', [
                'link'      => $tag->value,
                'text'      => $tag->text,
                'direction' => $tag->direction,
            ], true);
        }
    ],

    // CTA
    'cta' => [
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
    ],

    // CHEATSHEET SECTION IMPORT
    'reference' => [
        'html' => function ($tag) {
            if ($page = page('docs/reference/' . $tag->value())) {
                return snippet('reference/list/tag', [
                    'methods' => $page->children()->listed()
                ], true);
            }
        }
    ],

    // DOCS
    'docs' => [
        'attr' => [
            'field'
        ],
        'html' => function ($tag) {

            $snippet = snippet('docs/' . $tag->value, [
                'page'  => $tag->parent(),
                'field' => $tag->attr('field')
            ], true);

            return kirbytext($snippet);
        }
    ],

    // FIELD OPTIONS TABLE
    'field-options' => [
        'html' => function ($tag) {

            $type       = $tag->value;
            $definition = Field::setup($type);
            $props      = $definition['props'] ?? [];
            $table      = componentOptions($props);

            return snippet('field-options', ['rows' => $table], true);

        }
    ],

    // GLOSSARY
    'glossary' => [
        'attr' => [
            'text'
        ],
        'html' => function ($tag) {

            if ($entry = Glossary::entry($tag->value)) {

                $content  = Glossary::content($entry);
                $headline = Html::a(Glossary::url($entry), $entry->title());
                $tooltip  = Html::div([$headline], ['class' => 'bold -mb:small']) . $content;

                return Html::span($tag->text ?? $entry->title(), ['data-tooltip' => $tooltip]);
            }

            return Glossary::missingTerm($tag->value);

        }
    ],

    // NESTED GLOSSARY
    'glossary-nested' => [
        'attr' => [
            'text',
        ],
        'html' => function ($tag) {
            if ($entry = Glossary::entry($tag->value)) {
                return Html::a(Glossary::url($entry), $tag->text ?? $entry->title());
            }

            return Glossary::missingTerm($tag->value);
        }
    ],

    // PAGES GRID
    'pages' => [
        'html' => function ($tag) {
            $pages = Str::query($tag->value, [
                'page' => $tag->parent(),
                'site' => site(),
            ]);

            return snippet('pages', ['pages' => $pages], true);
        }
    ],

    // CUSTOM IMAGES
    'picture' => [
        'attr' => [
            'alt',
            'caption',
            'class',
            'height',
            'imgclass',
            'link',
            'linkclass',
            'rel',
            'size',
            'target',
            'text',
            'title',
            'width'
        ],
        'html' => function ($tag) {

            if ($tag->file = $tag->file($tag->value)) {
                $tag->src     = $tag->file->url();
                $tag->alt     = $tag->alt     ?? $tag->file->alt()->or(' ')->value();
                $tag->title   = $tag->title   ?? $tag->file->title()->value();
                $tag->caption = $tag->caption ?? $tag->file->caption()->value();
                $tag->ratio   = rtrim(rtrim(number_format($tag->file->height() / $tag->file->width() * 100, 10, '.', ''), '0'), '.');
            } else {
                $tag->src = Url::to($tag->value);
            }

            $link = function ($img) {
                if (empty($tag->link) === true) {
                    return $img;
                }

                return Html::a($tag->link === 'self' ? $tag->src : $tag->link, [$img], [
                    'rel'    => $tag->rel,
                    'class'  => trim('link-reset ' . $tag->linkclass),
                    'target' => $tag->target
                ]);
            };

            $image = Html::img($tag->src, [
                'width'  => $tag->width,
                'height' => $tag->height,
                'class'  => $tag->imgclass,
                'title'  => $tag->title,
                'alt'    => $tag->alt ?? ' '
            ]);

            if ($tag->file) {
                $placeholder = Html::span('', [
                    'class' => 'img-ratio-placeholder',
                    'style' => "padding-top: {$tag->ratio}%;",
                ]);

                $wrapperWidth = $tag->width ?? $tag->file->width();
                $wrapperAttr  = ['class' => 'img-wrap'];

                if (in_array($tag->size, ['banner', 'large']) === false) {
                    $wrapperAttr['style'] = "max-width: {$wrapperWidth}px;";
                }

                $image = Html::span([$placeholder, $image], $wrapperAttr);
            }

            return Html::figure([ $link($image) ], $tag->caption, [
                'class' => trim($tag->class . ' figure -size:' . $tag->size)
            ]);
        }
    ],

    // SCREENSHOT
    'screenshot' => [
        'attr' => [
            'alt',
            'caption',
            'class',
            'height',
            'imgclass',
            'link',
            'linkclass',
            'rel',
            'device',
            'target',
            'text',
            'title',
            'width'
        ],
        'html' => function ($tag) {

            if ($tag->file = $tag->file($tag->value)) {
                $tag->src     = $tag->file->resize(1200)->url();
                $tag->alt     = $tag->alt     ?? $tag->file->alt()->or(' ')->value();
                $tag->title   = $tag->title   ?? $tag->file->title()->value();
                $tag->caption = $tag->caption ?? $tag->file->caption()->value();
                $tag->ratio   = rtrim(rtrim(number_format($tag->file->height() / $tag->file->width() * 100, 10, '.', ''), '0'), '.');
            } else {
                $tag->src = Url::to($tag->value);
            }

            $link = function ($img) {
                if (empty($tag->link) === true) {
                    return $img;
                }

                return Html::a($tag->link === 'self' ? $tag->src : $tag->link, [$img], [
                    'rel'    => $tag->rel,
                    'class'  => trim('link-reset ' . $tag->linkclass),
                    'target' => $tag->target
                ]);
            };

            $image = Html::img($tag->src, [
                'width'  => $tag->width,
                'height' => $tag->height,
                'class'  => $tag->imgclass,
                'title'  => $tag->title,
                'alt'    => $tag->alt ?? ' '
            ]);

            if ($tag->file) {
                $placeholder = Html::span('', [
                    'class' => 'img-ratio-placeholder',
                    'style' => "padding-top: {$tag->ratio}%;",
                ]);

                $wrapperWidth = $tag->width ?? $tag->file->width();
                $wrapperAttr  = ['class' => 'img-wrap'];

                $wrapperAttr['style'] = "max-width: {$wrapperWidth}px;";

                $image = Html::span([$placeholder, $image], $wrapperAttr);
            }

            return Html::figure([ $link($image) ], $tag->caption, [
                'class' => trim($tag->class . 'screenshot ' . $tag->device)
            ]);
        }
    ],

    // SECTION OPTIONS TABLE
    'section-options' => [
        'html' => function ($tag) {

            $type       = $tag->value;
            $definition = Section::setup($type);
            $props      = $definition['props'] ?? [];
            $table      = componentOptions($props);

            return snippet('field-options', ['rows' => $table], true);

        }
    ],

];
