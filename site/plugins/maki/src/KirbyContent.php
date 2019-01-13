<?php

namespace Kirby\Maki;

use Kirby\Toolkit\F;
use Kirby\Toolkit\Str;

class KirbyContent
{

    public static function parse(string $text = null): string
    {
        $text   = static::normalizeNewLines($text);
        $lines  = explode("\n", $text);
        $indent = [];

        // Loop through all lines to find out which one has
        // the least indentation.
        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }

            $indent[] = strlen($line) - strlen(ltrim($line, ' '));
        }

        $indent = empty($indent) ? 0 : min($indent);
        $lines  = array_map(function ($line) use ($indent) {
            return substr($line, $indent);
        }, $lines);

        return implode("\n", $lines);
    }

    public static function normalizeNewLines($str): string {
        return str_replace(["\r\n", "\r"], "\n", $str);
    }

}
