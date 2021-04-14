<?php

function ariaCurrent(bool $condition, $type = true, string $prefix = ' ')
{
    return $condition ? $prefix . attr(['aria-current' => $type]) : null;
}

function icon($name)
{
    return svg('assets/icons/' . $name . '.svg');
}

function img($file, array $props = [])
{
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

    return '<img ' . attr([
        'alt'     => $props['alt'] ?? '',
        'class'   => $props['class'] ?? null,
        'loading' => $loading,
        'src'     => $src,
        'srcset'  => $srcset,
    ]) . '>';
}

function json(array $data, bool $pretty = true) {
    if ($pretty === true) {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    return json_encode($data);
}

function version(string $version, string $format = '%s'): string
{
    return Html::a(
        option('github') . '/kirby/releases/tag/' . $version,
        sprintf($format, $version)
    );
}
