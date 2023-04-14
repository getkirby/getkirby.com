<?php

use Kirby\Toolkit\Html;
use Kirby\Toolkit\Xml;

function ariaCurrent(bool $condition, $type = true, string $prefix = ' ')
{
    return $condition ? $prefix . attr(['aria-current' => $type]) : null;
}

function icon(string $name)
{
    return svg('assets/icons/' . $name . '.svg');
}

function img($file, array $props = [])
{
    if (is_string($file) === true) {
        $file = image($file);
    }

    if (!$file) {
        return;
    }

    if (empty($props['src']) === true) {
        $src = $file->url();
    } else {
        $src = $file->thumb($props['src'])->url();
    }

    if (empty($props['srcset']) === true) {
        $srcset = null;
    } else {
        $srcset = $file->srcset($props['srcset']);
    }

    if (($props['lazy'] ?? true) === true) {
        $loading = 'lazy';
    } else {
        $loading = null;
    }

    $img = '<img ' . attr([
        'alt'     => $props['alt'] ?? ' ',
        'class'   => $props['class'] ?? null,
        'loading' => $loading,
        'src'     => $src,
        'srcset'  => $srcset,
    ]) . '>';

    if (empty($props['lightbox']) === false && $props['lightbox'] !== false) {
        return Html::a($file->resize(1800, 1800)->url(), [$img], [
            'class'         => 'block',
            'style'         => '--aspect-ratio: ' . $file->width() . '/' . $file->height(),
            'data-lightbox' => $props['lightbox']
        ]);
    }

    return $img;
}

function json(array $data, bool $pretty = true): string|false {
    if ($pretty === true) {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    return json_encode($data);
}

function version(string $version, string $format = '%s'): string
{
    return Html::a(
        option('github.url') . '/kirby/releases/tag/' . $version,
        sprintf($format, $version)
    );
}

if (function_exists('xml') === false) {
    function xml($value) {
        return Xml::encode($value);
    }
}
