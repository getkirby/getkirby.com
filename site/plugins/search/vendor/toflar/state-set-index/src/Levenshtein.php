<?php

namespace Toflar\StateSetIndex;

class Levenshtein
{
    public static function distance(string $string1, string $string2, int $insertionCost = 1, $replacementCost = 1, $deletionCost = 1): int
    {
        $map = [];
        $string1 = self::utf8_to_extended_ascii($string1, $map);
        $string2 = self::utf8_to_extended_ascii($string2, $map);

        return levenshtein($string1, $string2, $insertionCost, $replacementCost, $deletionCost);
    }

    private static function utf8_to_extended_ascii($str, &$map)
    {
        // find all multibyte characters (cf. utf-8 encoding specs)
        $matches = [];
        if (!preg_match_all('/[\xC0-\xF7][\x80-\xBF]+/', $str, $matches)) {
            return $str;
        } // plain ascii string

        // update the encoding map with the characters not already met
        foreach ($matches[0] as $mbc) {
            if (!isset($map[$mbc])) {
                if (\count($map) >= 128) {
                    throw new \InvalidArgumentException('Strings with more than 128 individual unicode characters are not supported.');
                }
                $map[$mbc] = \chr(128 + \count($map));
            }
        }

        // finally remap non-ascii characters
        return strtr($str, $map);
    }
}
