<?php

namespace Kirby\Reference;

use Kirby\Toolkit\A;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;

use \ReferenceClassPage;
use \ReferenceClassMethodPage;
use \ReferenceFieldMethodPage;
use \ReferenceHelperPage;
use ReflectionClass;

class Types
{

    /**
     * Returns the proper CSS classes for type
     */
    public static function class(string $type): string
    {
        return 'type type-' . $type;
    }

    public static function default(string $value = null): string
    {
        return match ($value) {
            null    => '<span>–</span>',
            default => static::format($value)
        };
    }

    public static function factory(string $string, $model): string
    {
        $types = A::map(
            explode('|', $string),
            fn ($type) => match ($type) {
                'static',
                '$this'
                    => $model->parent()->class(),
                'self'
                    => $model->inheritedFrom() ?? $model->parent()->class(),
                default
                    => substr($type, 0, 1) === '\\' ? substr($type, 1) : $type
            }
        );

        return implode('|', array_unique($types));
    }

    /**
     * Parses the string and tries to find and return a matching
     * reference page for the class, class method, field method or helper

     */
    public static function findReferencePage(
        string $string
    ): ReferenceClassPage|ReferenceClassMethodPage|ReferenceFieldMethodPage|null {
        //:: or -> separating class and method
        $chain  = preg_split('/::|->/', $string);
        $class  = array_shift($chain);

        if (count($chain) > 0) {
            // Remove leading $
            $class = ltrim($class, '$');

            if (strtolower($class) === 'field') {
                return ReferenceFieldMethodPage::findByName($chain[0]);
            }
            if (strtolower($class) === 'helper') {
                return ReferenceHelperPage::findByName($chain[0]);
            }
        }

        // Get page for base class/object
        if ($page = ReferenceClassPage::findByName($class)) {

            // If type is only the class, return the page
            if (count($chain) === 0) {
                return $page;
            }

            // Clean up method names
            $methods = A::map(
                $chain,
                fn ($method) => preg_replace('/\(.*\)$/', '', $method)
            );

            // If method page can be found by chain, return that page
            return ReferenceClassMethodPage::findByNames($page, $methods);
        }

        return null;
    }

    /**
     * Takes a type tring and wraps it in a <code> tag with the
     * matching CSS classes. Also links to Reference for classes or
     * class methods. Supports multiple types separated by | as well.
     *
     * @param bool $withLink should the tag be linked (if possible) or not
     * @param string $text label text to use instead type
     */
    public static function format(
        string|null $type = null,
        bool $withLink = true,
        string|null $text = null
    ): string {
        if($type === null || $type === '') {
            return '';
        }

        // Any type containing at least one whitespace, any character
        // or sequence that cannot be part of a datatype,
        // just return a plain code element.
        if (
            preg_match('/^[^\\a-z0-9_\->:]+$/iu', $type) === 1 ||
            preg_match('/\?[^a-z]/i', $type) === 1
        ) {
            return '<code>' . Html::encode($text ?? $type) . '</code>';
        }

        // handle nullable types
        if (Str::startsWith($type, '?')) {
            $type = substr($type, 1) . '|null';
        }

        // Multiple datatypes
        if (Str::contains($type, '|')) {
            $types = explode('|', $type);

            // Don’t process code blocks, that contain empty elements
            if (in_array('', $types) === true) {
                return "<code>{$type}</code>";
            }

            $types = A::map(
                $types,
                fn ($t) => static::format($t, $withLink)
            );

            return implode('<span class="px-1">|</span>', $types);
        }

        // Native PHP/JS datatypes
        $natives = [
            'string',
            'int',
            'float',
            'number',
            'bool',
            'boolean',
            'array',
            'object',
            'mixed',
            'null',
        ];

        $native = strtolower($type);

        if (in_array($native, $natives) === true) {
            return static::tag($type, $native);
        }

        // Implied native datatypes
        $implied = [
            'false' => 'bool',
            'true'  => 'bool'
        ];

        if (in_array($type, array_keys($implied)) === true) {
            return static::tag($type, $implied[$type]);
        }

        $text = $text ?? $type;

        // Assume, it’s a class or class method name
        // (starting with a letter, \ or $)
        if (preg_match('/^[A-Z\\\$]/', $type) === 1) {

            // Check if reference page for Kirby class
            // or class method exists
            if ($page = static::findReferencePage($type)) {
                $class = $page instanceof ReferenceClassPage ? 'object' : 'method';
                $tag   = static::tag($text, $class);

                if ($withLink === true) {
                    $tag = Html::a(
                        $page->url(),
                        [$tag],
                        ['class' => 'type-link']
                    );
                }

                return $tag;
            }

            // Some class that exists in PHP in the global namespace.
            // The second check is done to ensure correct case,
            // as `class_exists()` is not case-sensitive.
            if (
                class_exists($type) === true &&
                (new ReflectionClass($type))->getName() === $type
            ) {
                return static::tag($text, 'class');
            }
        }

        // Probably a code example (not a datatype),
        // just return a plain code tag
        return static::tag($text);
    }


    /**
     * Extracts variable and type from parameter definition
     */
    public static function parameter(string $parameter): array
    {
        $argument = explode('=', $parameter);
        $argument = explode(' ', trim($argument[0]));

        return [
            'variable' => $argument[count($argument) - 1],
            'type'     => static::format($argument[count($argument) - 2] ?? '-')
        ];
    }

    /**
     * Returns required asteriks markup if required flag is true
     */
    public static function required(bool $required): string|null
    {
        return match ($required) {
            true    => '<span class="required-mark">*</span>',
            default => null
        };
    }

    /**
     * Wraps the type string in code tag with matching CSS classes
     */
    public static function tag(string $type, string $class = null): string
    {
        return Html::tag('code', $type, [
            'class' => $class ? static::class($class) : null,
        ]);
    }
}
