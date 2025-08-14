<?php

/**
 * Part of the Joomla Framework String Package
 *
 * @copyright  Copyright (C) 2005 - 2021 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\String;

/**
 * Joomla Framework String Normalise Class
 *
 * @since  1.0
 */
abstract class Normalise
{
    /**
     * Method to convert a string from camel case.
     *
     * This method offers two modes. Grouped allows for splitting on groups of uppercase characters as follows:
     *
     * "FooBarABCDef"            becomes  array("Foo", "Bar", "ABC", "Def")
     * "JFooBar"                 becomes  array("J", "Foo", "Bar")
     * "J001FooBar002"           becomes  array("J001", "Foo", "Bar002")
     * "abcDef"                  becomes  array("abc", "Def")
     * "abc_defGhi_Jkl"          becomes  array("abc_def", "Ghi_Jkl")
     * "ThisIsA_NASAAstronaut"   becomes  array("This", "Is", "A_NASA", "Astronaut"))
     * "JohnFitzgerald_Kennedy"  becomes  array("John", "Fitzgerald_Kennedy"))
     *
     * Non-grouped will split strings at each uppercase character.
     *
     * @param   string   $input    The string input (ASCII only).
     * @param   boolean  $grouped  Optionally allows splitting on groups of uppercase characters.
     *
     * @return  array|string  The space separated string, as an array if grouped.
     *
     * @since   1.0
     */
    public static function fromCamelCase($input, $grouped = false)
    {
        return $grouped
            ? preg_split('/(?<=[^A-Z_])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][^A-Z_])/x', $input)
            : trim(preg_replace('#([A-Z])#', ' $1', $input));
    }

    /**
     * Method to convert a string into camel case.
     *
     * @param   string  $input  The string input (ASCII only).
     *
     * @return  string  The camel case string.
     *
     * @since   1.0
     */
    public static function toCamelCase($input)
    {
        // Convert words to uppercase and then remove spaces.
        $input = static::toSpaceSeparated($input);
        $input = ucwords($input);
        $input = str_ireplace(' ', '', $input);

        return $input;
    }

    /**
     * Method to convert a string into dash separated form.
     *
     * @param   string  $input  The string input (ASCII only).
     *
     * @return  string  The dash separated string.
     *
     * @since   1.0
     */
    public static function toDashSeparated($input)
    {
        // Convert spaces and underscores to dashes.
        return preg_replace('#[ \-_]+#', '-', $input);
    }

    /**
     * Method to convert a string into space separated form.
     *
     * @param   string  $input  The string input (ASCII only).
     *
     * @return  string  The space separated string.
     *
     * @since   1.0
     */
    public static function toSpaceSeparated($input)
    {
        // Convert underscores and dashes to spaces.
        return preg_replace('#[ \-_]+#', ' ', $input);
    }

    /**
     * Method to convert a string into underscore separated form.
     *
     * @param   string  $input  The string input (ASCII only).
     *
     * @return  string  The underscore separated string.
     *
     * @since   1.0
     */
    public static function toUnderscoreSeparated($input)
    {
        // Convert spaces and dashes to underscores.
        return preg_replace('#[ \-_]+#', '_', $input);
    }

    /**
     * Method to convert a string into variable form.
     *
     * @param   string  $input  The string input (ASCII only).
     *
     * @return  string  The variable string.
     *
     * @since   1.0
     */
    public static function toVariable($input)
    {
        // Remove dashes and underscores, then convert to camel case.
        $input = static::toCamelCase($input);

        // Remove leading digits.
        $input = preg_replace('#^[0-9]+#', '', $input);

        // Lowercase the first character.
        $input = lcfirst($input);

        return $input;
    }

    /**
     * Method to convert a string into key form.
     *
     * @param   string  $input  The string input (ASCII only).
     *
     * @return  string  The key string.
     *
     * @since   1.0
     */
    public static function toKey($input)
    {
        // Remove spaces and dashes, then convert to lower case.
        return strtolower(static::toUnderscoreSeparated($input));
    }
}
