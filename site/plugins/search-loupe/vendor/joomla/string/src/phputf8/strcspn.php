<?php

/**
* @package utf8
*/

//---------------------------------------------------------------
/**
* UTF-8 aware alternative to strcspn
* Find length of initial segment not matching mask
* Note: requires utf8_strlen and utf8_substr (if start, length are used)
* @param string
* @return int
* @see http://www.php.net/strcspn
* @see utf8_strlen
* @package utf8
*/
function utf8_strcspn($str, $mask, $start = null, $length = null)
{
    if (empty($mask) || strlen($mask) == 0) {
        return null;
    }

    $mask = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $mask);

    if ($start !== null || $length !== null) {
        $str = utf8_substr($str, $start, $length);
    }

    preg_match('/^[^' . $mask . ']+/u', $str, $matches);

    if (isset($matches[0])) {
        return utf8_strlen($matches[0]);
    }

    return 0;
}
