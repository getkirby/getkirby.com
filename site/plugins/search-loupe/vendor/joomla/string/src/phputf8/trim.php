<?php

/**
* @package utf8
*/

//---------------------------------------------------------------
/**
* UTF-8 aware replacement for ltrim()
* Note: you only need to use this if you are supplying the charlist
* optional arg and it contains UTF-8 characters. Otherwise ltrim will
* work normally on a UTF-8 string
* @author Andreas Gohr <andi@splitbrain.org>
* @see http://www.php.net/ltrim
* @see http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
* @return string
* @package utf8
*/
function utf8_ltrim($str, $charlist = false)
{
    if ($charlist === false) {
        return ltrim($str);
    }

    //quote charlist for use in a characterclass
    $charlist = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $charlist);

    return preg_replace('/^[' . $charlist . ']+/u', '', $str);
}

//---------------------------------------------------------------
/**
* UTF-8 aware replacement for rtrim()
* Note: you only need to use this if you are supplying the charlist
* optional arg and it contains UTF-8 characters. Otherwise rtrim will
* work normally on a UTF-8 string
* @author Andreas Gohr <andi@splitbrain.org>
* @see http://www.php.net/rtrim
* @see http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
* @return string
* @package utf8
*/
function utf8_rtrim($str, $charlist = false)
{
    if ($charlist === false) {
        return rtrim($str);
    }

    //quote charlist for use in a characterclass
    $charlist = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $charlist);

    return preg_replace('/[' . $charlist . ']+$/u', '', $str);
}

//---------------------------------------------------------------
/**
* UTF-8 aware replacement for trim()
* Note: you only need to use this if you are supplying the charlist
* optional arg and it contains UTF-8 characters. Otherwise trim will
* work normally on a UTF-8 string
* @author Andreas Gohr <andi@splitbrain.org>
* @see http://www.php.net/trim
* @see http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
* @return string
* @package utf8
*/
function utf8_trim($str, $charlist = false)
{
    if ($charlist === false) {
        return trim($str);
    }
    return utf8_ltrim(utf8_rtrim($str, $charlist), $charlist);
}
