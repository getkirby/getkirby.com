<?php

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

function formatDefault(?string $value = null): string
{
    return is_null($value) === false ? formatType($value) : '<span class="properties-empty">–</span>';
}

function typeClass($type)
{
    return 'type type-' . $type;
}

function formatRequired($required) {
    return $required ? '<abbr title="required" class="cheatsheet-required">*</abbr>' : '';
}

function formatType(?string $type = null): ?string
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
            return formatType($value);
        }, $types);

        return implode('<span class="type-separator">|</span>', $types);
    }

    if (in_array($type, $builtinDatatypes) === true) {
        // Atomic PHP datatype
        return Html::tag('code', $type, [
            'class' => typeClass($type),
        ]);
    }

    if (preg_match('/^[A-Z]/', $type) === 1) {
        // Assume, it’s a class name

        // Namespaced class name, look whether it’s a Kirby classs
        if ($lookup = lookup($type)) {
            return '<code class="' . typeClass('object') . '"><a href="' . $lookup->url(). '">' . $type . '</a></code>';
        }

        // Some class that exists in PHP in the global namespace. The
        // seconds check is done to ensure correct case, as `class_exists()``
        // is not case-sensitive.
        if (
            class_exists($type) === true &&
            (new ReflectionClass($type))->getName() === $type
        ) {
            return Html::tag('code', $type, [
                'class' => typeClass('class'),
            ]);
        }
    }

    // Probably a code example (not a datatype), just return a plain code tag.
    return "<code>{$type}</code>";
}

function lookup(string $class)
{
    // don't even start to look if the class does not exist in Kirby
    if (class_exists($class) === false) {
        return false;
    }

    $cache   = kirby()->cache('classes');
    $cacheId = Str::slug($class);
    $id      = $cache->get($cacheId);

    if ($id === -1) {
        return null;
    }

    if (empty($id) === false) {
        return page($id);
    }

    $roots = [
        'docs/reference/objects',
        'docs/reference/tools',
        'docs/reference/@'
    ];

    foreach ($roots as $root) {
        if ($root = page($root)) {
            if ($page = $root->index()->findBy('class', $class)) {
                $cache->set($cacheId, $page->id());
                return $page;
            }
        }
    }

    $cache->set($cacheId, -1);

}

function parseForReferences(string $string, string $parent): string
{
    return preg_replace_callback("|\`(.*)\`|", function ($matches) use ($parent) {
        // remove ()
        $matches[1] = Str::trim($matches[1], '()');
        // split namespace parts
        $namespace  = Str::split($matches[1], '\\');

        // defined without namespace
        if (count($namespace) === 1) {
            $class    = Str::split($parent, '\\');
            $class[2] = Str::before($namespace[0], '::');
            $class    = implode('\\', $class);
            $method   = Str::after($namespace[0], '::');

        // defined with full namespace
        } else {
            $class   = Str::before($matches[1], '::');
            $method  = Str::after($matches[1], '::');
        }

        if ($obj = lookup($class)) {
            if ($method = $obj->find(Str::kebab($method))) {
                return Html::a($method->url(), $matches[0]);
            }
        }

        return $matches[0];

    }, $string);
}

function types(string $string, $model)
{
    if ($string === 'self') {
        $string = $model->parent()->class();
    }

    $types = array_map(function ($type) {
        return substr($type, 0, 1) === '\\' ? substr($type, 1) : $type;
    }, explode('|', $string));

    return implode('|', $types);
}
