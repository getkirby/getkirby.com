<?php

use Kirby\Toolkit\Str;
use Kirby\Toolkit\Html;

function availableIcons()
{

    $icons    = [];

    $icons = glob(__DIR__ . '/icons/*');
    foreach($icons as $i => $name) {
        $icons[$i] = pathinfo($name, PATHINFO_FILENAME);
    }

    return $icons;
}

function iconRoot($name)
{
    return __DIR__ . '/icons/' . $name . '.svg';
}

// Load an icon from SVG sprite
function icon(string $name, bool $return = false, array $attr = null)
{

    $iconRoot = iconRoot($name);

    if (file_exists($iconRoot) === true) {

        $icon = trim(file_get_contents($iconRoot));

        if ($attr !== null) {
            // replace attributes on `<svg>` tag if $attr param is set.
            $xml          = simplexml_load_string($icon);
            $originalAttr = $xml->attributes();
            $newAttr      = [];

            foreach ($originalAttr as $name => $value) {
                $newAttr[(string) $name] = (string) $value;
            }

            $newAttr = array_merge($newAttr, $attr);

            if (isset($originalAttr['class']) && isset($attr['class'])) {
                // class attribute is merged, rather than overridden
                $newAttr['class'] = trim("{$originalAttr['class']} {$attr['class']}");
            }

            $icon = preg_replace('/^<svg ([^>]+)>/sU', '<svg ' . Html::attr($newAttr) . '>', $icon);
        }

    } else {
        $icon = '<!-- Missing Icon: ' . $name . ' --><svg viewBox="0 0 16 16" width="16" height="16"><path style="fill: #ff0000 !important;" d="M15,0H1C0.4,0,0,0.4,0,1v14c0,0.6,0.4,1,1,1h14c0.6,0,1-0.4,1-1V1C16,0.4,15.6,0,15,0z M8,12 c-0.6,0-1-0.4-1-1c0-0.6,0.4-1,1-1s1,0.4,1,1C9,11.6,8.6,12,8,12z M9,9H7V4h2V9z"></path></svg>';
    }

    if ($return === true) {
        return $icon;
    }

    echo $icon;

}

function version(string $version, string $format = '%s'): string
{
    return Html::a(option('github') . '/kirby/releases/tag/' . $version, sprintf($format, $version));
}
