<?php
/**
 * @copyright 2024 Nito T.M.
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Nito T.M. (https://github.com/nitotm)
 * @package nitotm/efficient-language-detector
 */

echo (PHP_SAPI === 'cli' ? '' : "<pre>") . PHP_EOL;

require_once 'manual_loader.php';
// require __DIR__ . '/vendor/autoload.php';

use Nitotm\Eld\LanguageDetector;
use Nitotm\Eld\EldDataFile; // not mandatory
use Nitotm\Eld\EldFormat; // not mandatory

// LanguageDetector(databaseFile: ?string, outputFormat: ?string)
$eld = new LanguageDetector(EldDataFile::SMALL, EldFormat::ISO639_1); // Default file and format
// Database files: 'small', 'medium', 'large', 'extralarge'. Check memory requirements at README
// Language formats: 'ISO639_1', 'ISO639_2T', 'ISO639_1_BCP47', 'ISO639_2T_BCP47' and 'FULL_TEXT'
// Argument constants are not mandatory, LanguageDetector('small', 'ISO639_1'); will also work

/*
 detect() expects a UTF-8 string, returns an object with a 'language' property, with an ISO 639-1 code (or other
 selected format), or 'und' for undetermined language.
*/
var_dump($result = $eld->detect('Hola, cómo te llamas?'));
// object( language => string, scores() => array<string, float>, isReliable() => bool )
// ( language => 'es', scores() => ['es' => 0.25, 'nl' => 0.05], isReliable() => true )
// ( language => 'und', scores() => [], isReliable() => false )

var_dump($result->language); // 'es'

/*
 We can use a subset of languages, calling langSubset() once, will set it. The first time is expensive as it creates
 a new database, if saving the database file (default), it will be loaded next time we make the same subset.
 It always accepts ISO 639-1 codes, as well as the selected output format if different.
 langSubset(languages: [], save: true, encode: true)
*/
var_dump($eld->langSubset(['en', 'es', 'fr', 'it', 'nl', 'de'])); // returns subset file name if saved
// Object ( success => bool, languages => ?array, error => ?string, file => ?string )
// ( success => true, languages => ['en', 'es', ...], error => NULL, file => 'small_6_mfss5...' )

// to remove the subset
$eld->langSubset();

/*
 To use a subset without additional overhead, the proper way is to instantiate the detector with the file saved
  and returned by langSubset(), it will be loaded as if it were a default database
*/
$eld_subset = new Nitotm\Eld\LanguageDetector('small_6_mfss5z1t');

/*
 This is the complete list on languages for ELD v3, using ISO 639-1 codes:
 ['am', 'ar', 'az', 'be', 'bg', 'bn', 'ca', 'cs', 'da', 'de', 'el', 'en', 'es', 'et', 'eu', 'fa', 'fi', 'fr', 'gu',
 'he', 'hi', 'hr', 'hu', 'hy', 'is', 'it', 'ja', 'ka', 'kn', 'ko', 'ku', 'lo', 'lt', 'lv', 'ml', 'mr', 'ms', 'nl',
 'no', 'or', 'pa', 'pl', 'pt', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'sv', 'ta', 'te', 'th', 'tl', 'tr', 'uk', 'ur',
 'vi', 'yo', 'zh']
*/

// enableTextCleanup(true) Removes Urls, .com domains, emails, alphanumerical & numbers. Default is 'false'
// Not recommended as urls, domains, etc. may be related to a language, and ELD is trained without "cleaning"
$eld->enableTextCleanup(true); // Only needs to be set once to apply to all subsequent detect()

// If needed, we can get some info of the ELD instance: languages, database type, etc.
var_dump($eld_subset->info());

echo(PHP_SAPI === 'cli' ? '' : "</pre>");
