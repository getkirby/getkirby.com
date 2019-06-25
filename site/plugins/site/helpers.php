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

function cheatsheetAdvanced($page)
{
    if (param('advanced') !== 'true') {
        return Html::a($page->url() . '/advanced:true',  'Advanced view ›');
    }

    return Html::a($page->url(),  'Simple view ›');
}

function formatRequired($required) {
    return $required ? '<abbr title="required" class="cheatsheet-required">*</abbr>' : '';
}

function csv(string $file): array
{

    $lines = file($file);
    $lines[0] = str_replace("\xEF\xBB\xBF", '', $lines[0]);

    $csv = array_map('str_getcsv', $lines);

    array_walk($csv, function(&$a) use ($csv) {
        $a = array_combine($csv[0], $a);
    });

    array_shift($csv);

    return $csv;
}

function iconRoot($name)
{
    return __DIR__ . '/icons/' . $name . '.svg';
}

function formatDatatype(?string $type = null): ?string
{
    $builtinDatatypes = [
        'string',
        'int',
        'float',
        'bool',
        'array',
        'object',
        'mixed',
        'null',
    ];

    if(empty($type) === true) {
        return '';
    }

    if (preg_match('/^[^\\a-z0-9_]+$/iu', $type) === 1) {
        // any tyype containing at least one whitespace or any character
        // that cannot be part of a datatype, just return a plain
        // code element.
        return "<code>{$type}</code>";
    }

    if (Str::contains($type, '|')) {
        // Multiple datatypes
        $types = explode('|', $type);

        if (in_array('', $types)) {
            // Don’t process code blocks, that contain empty elements
            return "<code>{$type}</code>"; 
        }

        $types = array_map(function ($value) {
            return formatDatatype($value);
        }, $types);

        return implode('<span class="type-separator">|</span>', $types);
    }

    if (in_array($type, $builtinDatatypes) === true) {
        // Atomic PHP datatype
        return Html::tag('code', $type, [
            'class' => "type type-{$type}",
        ]);
    }

    if (preg_match('/^[A-Z]/', $type) === 1) {
        // Assume, it’s a class name

        if ($lookup = referenceLookup($type)) {
            // Namespaced class name, look whether it’s a Kirby classs
            return "<code class=\"type type-class\"><a href=\"{$lookup->url()}\">{$type}</a></code>";
        } else if (class_exists($type) === true && (new ReflectionClass($type))->getName() === $type) {
            // Some class that exists in PHP in the global namespace. The
            // seconds check is done to ensure correct case, as `class_exists()``
            // is not case-sensitive.
            return Html::tag('code', $type, [
                'class' => "type type-class",
            ]);
        }
    }

    // Probably a code example (not a datatype), just return a plain code tag.
    return "<code>{$type}</code>";
}

function formatDefault(?string $value = null): string
{
    return is_null($value) === false ? formatDatatype($value) : '<span class="properties-empty">–</span>';
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

function referenceLookup(string $class)
{
    $roots = [
        'docs/reference/objects',
        'docs/reference/tools',
        'docs/reference/@'
    ];

    foreach ($roots as $root) {
        $index = page($root)->index();
        if ($page = $index->filterBy('class', $class)->first()) {
            return $page;
        }
    }
}

function parseObjectReference(string $string, string $parent): string
{
    return kirbytext(preg_replace_callback("|\`(.*)\`|", function ($matches) use ($parent) {
        $matches[1] = Str::trim($matches[1], '()');
        $namespace = Str::split($matches[1], '\\');


        if (count($namespace) === 1) {
            $class    = Str::split($parent, '\\');
            $class[2] = Str::before($namespace[0], '::');
            $class    = implode('\\', $class);
            $method   = Str::after($namespace[0], '::');
        } else {
            $class = Str::before($matches[1], '::');
            $method  = Str::after($matches[1], '::');
        }

        if ($obj = referenceLookup($class)) {
            if ($method = $obj->find(Str::kebab($method))) {
                return Html::a($method->url(), $matches[0]);
            }
        }

        return $matches[0];

    }, $string));
}

function version(string $version, string $format): string
{
    return Html::a(option('github') . '/kirby/releases/tag/' . $version, sprintf($format, $version));
}
