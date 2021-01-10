<?php

use Kirby\Toc\Toc;

return [
    'toToc' => function ($field, string $headline = 'h2') {
        return Toc::headlines($field, $headline);
    },
    'withAnchorHeadlines' => function ($field, string $headlines = 'h2|h3') {
        return Toc::anchors($field, $headlines);
    },
    'withCode' => function ($field) {
        $field->value = preg_replace(
            '$\`(.*?)\`$',
            '<code>$1</code>',
            $field->value
        );
        return $field;
    },

    /* Legacy */
    'replace' => function ($field, $replace) {
        $field->value = Str::template($field->value(), $replace);

        return $field;
    },
    'version' => function ($field, $format = '%s') {
        return $field->isEmpty() ? '' : version($field->value(), $format);
    }
];
