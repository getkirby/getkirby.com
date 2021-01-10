<?php

use Kirby\Toolkit\Html;

function icon($attrs = []): string
{
    if (is_string($attrs)) {
        $attrs = ['type' => $attrs];
    }

    return snippet('icon', $attrs, true);
}

function field($value)
{
    if (is_a($value, 'Kirby\Cms\Field') === false) {
        $value = page()->customField()->value($value);
    }

    return $value;
}

function version(string $version, string $format = '%s'): string
{
    return Html::a(option('github') . '/kirby/releases/tag/' . $version, sprintf($format, $version));
}