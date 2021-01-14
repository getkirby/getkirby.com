<?php

namespace Kirby\Compressor;

class Cache extends \Kirby\Cache\ApcuCache
{

    public function set(string $key, $value, int $minutes = 0): bool
    {

        $html = $value['html'];

        $search = [
            '/\>[^\S ]+/s',
            '/[^\S ]+\</s',
            '/(\s)+/s'
        ];

        $replace = [
            '>',
            '<',
            '\\1'
        ];

        if (preg_match("/\<html/i", $html) && preg_match("/\<\/html\>/i", $html)) {
            $html = preg_replace($search, $replace, $html);
        }

        $html .= PHP_EOL . '<!-- compressor cache -->';
        $value['html'] = $html;

        return parent::set($key, $value, $minutes);
    }
}
