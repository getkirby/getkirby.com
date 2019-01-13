<?php

namespace Kirby\Maki;

use Kirby\Cms\Html;
use Kirby\Cms\Page;

class Glossary
{

    public static function content(Page $entry)
    {
        // This is a workaround to prevent glossary tags within
        // glossary texts to generate nested tooltips.
        return $entry->entry()->value(function ($value) {
            return str_replace('(glossary:', '(glossary-nested:', $value);
        })->kt();
    }

    public static function entry(string $term)
    {
        return page('docs/glossary/' . $term);
    }

    public static function missingTerm(string $term): string
    {
        return Html::span('⚠️ Glossary term “' . $term .'” not found.', [
            'style' => 'background: rgba(255,0,0,.05); color: red; padding: 0 .25em',
        ]);
    }

    public static function url($entry)
    {
        return $entry->parent()->url() . '/#' . $entry->slug();
    }

}

