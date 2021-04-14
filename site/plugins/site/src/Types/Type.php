<?php

namespace Kirby\Types;

use Kirby\Cms\Page;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;

use \ReferenceClassPage;
use ReflectionClass;

class Type
{

    /**
     * Returns the proper CSS classes for type
     *
     * @param string $type
     * @return string
     */
    public static function class(string $type): string
    {
        return 'type type-' . $type;
    }

    public static function default(?string $value = null): string
    {
        if ($value !== null) {
            return static::format($value);
        }

        return '<span>–</span>';
    }

    public static function factory(string $string, $model): string
    {
        $types = array_map(function ($type) use ($model) {

            if ($type === 'static' || $type === '$this') {
                return $model->parent()->class();
            }

            if ($type === 'self') {
                return $model->inheritedFrom() ?? $model->parent()->class();
            }

            return substr($type, 0, 1) === '\\' ? substr($type, 1) : $type;

        }, explode('|', $string));

        return implode('|', array_unique($types));
    }

    /**
     * Takes a type tring and wraps it in a <code> tag with the
     * matching CSS class. Also links to Reference for classes or
     * class methods. Support multiple types separated by | as well.
     *
     * @param string|null $type
     * @param bool $withLink should the tag be linked (if possible) or not
     * @return string
     */
    public static function format(?string $type = null, bool $withLink = true): string
    {
        if(empty($type) === true) {
            return '';
        }

        // Any type containing at least one whitespace or any character
        // that cannot be part of a datatype, just return a plain
        // code element.
        if (preg_match('/^[^\\a-z0-9_]+$/iu', $type) === 1) {
            return "<code>{$type}</code>";
        }

        // Multiple datatypes
        if (Str::contains($type, '|')) {
            $types = explode('|', $type);

            // Don’t process code blocks, that contain empty elements
            if (in_array('', $types) === true) {
                return "<code>{$type}</code>";
            }

            $types = array_map(function ($t) use ($withLink) {
                return static::format($t, $withLink);
            }, $types);

            return implode('<span class="px-1">|</span>', $types);
        }

        $native = [
            'string',
            'int',
            'float',
            'bool',
            'array',
            'object',
            'mixed',
            'null',
        ];

        // Native PHP datatype
        if (in_array($type, $native) === true) {
            return static::tag($type, $type);
        }

        // Assume, it’s a class name
        if (preg_match('/^[A-Z]/', $type) === 1) {
            // Namespaced class name, look whether it’s a Kirby classs
            if ($class = ReferenceClassPage::findByName($type)) {
                return static::tag(
                    $type,
                    'object',
                    $withLink ? $class->url() : null
                );
            }

            // Some class that exists in PHP in the global namespace. The
            // seconds check is done to ensure correct case, as `class_exists()`
            // is not case-sensitive.
            if (
                isset($url) === false &&
                class_exists($type) === true &&
                (new ReflectionClass($type))->getName() === $type
            ) {
                return static::tag($type, 'class');
            }
        }

        // Probably a code example (not a datatype),
        // just return a plain code tag
        return static::tag($type);
    }

    public static function parse(string $string, string $parent)
    {
        return kirbytextinline(preg_replace_callback("|\`(.*)\`|", function ($matches) use ($parent) {
            $matches[1] = Str::trim($matches[1], '()');
            $namespace  = Str::split($matches[1], '\\');



            if (count($namespace) === 1) {
                $class    = Str::split($parent, '\\');
                $class[2] = Str::before($namespace[0], '::');
                $class    = implode('\\', $class);
                $method   = Str::after($namespace[0], '::');

            } else {
                $class = Str::before($matches[1], '::');
                $method  = Str::after($matches[1], '::');
            }

            if ($obj = ReferenceClassPage::findByName($class)) {
                if ($method = $obj->find(Str::kebab($method))) {
                    return '<code class="' . static::class('mixed') . '"><a href="' . $method->url() . '">' . $matches[0] . '</a></code>';
                }
            }

            return static::format($matches[0]);

        }, $string));
    }

    public static function required(bool $required)
    {
        if ($required) {
            return '<span class="required-mark">*</span>';
        }
    }

    protected static function tag(string $type, string $class = 'mixed', ?string $url = null): string
    {
        $tag = Html::tag('code', $type, [
            'class' => static::class($class),
        ]);

        if ($url) {
            $tag = Html::a($url, [$tag], ['class' => 'type-link']);
        }

        return $tag;
    }
}
