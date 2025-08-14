<?php
/**
 * @copyright 2024 Nito T.M.
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Nito T.M. (https://github.com/nitotm)
 * @package nitotm/efficient-language-detector
 */

namespace Nitotm\Eld;

/**
 * Performance critical
 */
class LanguageDetector extends LanguageData
{
    private bool $textCleanupEnabled = false;

    public function __construct(?string $databaseFile = null, ?string $outputFormat = null)
    {
        $this->loadData($databaseFile, $outputFormat);
    }

    /**
     * Returns the language detected for a given UTF-8 string, as ISO 639-1 code (default), or 'und' if undetermined
     *  LanguageResult object( language => string, scores() => array<string, float>, isReliable() => bool )
     *  ( language => 'es', scores() => ['es' => 0.5, 'et' => 0.2], isReliable() => true )
     *  ( language => 'und', scores() => [], isReliable() => false )
     */
    public function detect(string $text): LanguageResult
    {
        if ($this->textCleanupEnabled) {
            // Removes Urls, emails, alphanumerical & numbers
            $text = $this->cleanText($text);
        }
        $words = $this->getWords($text);
        $byteNgrams = $this->getByteNgrams($words);
        $scores = $this->calculateScores($byteNgrams);
        $maxScore = max($scores);
        // scores start at 1
        if ($maxScore > 1) {
            return new LanguageResult(
                array_search($maxScore, $scores, true), // max score language key
                $scores,
                $byteNgrams,
                $this->outputLanguages,
                $this->avgScore
            );
        }

        return new LanguageResult();
    }

    /**
     * Removes parts of a string, that may be considered "noise" for language detection
     */
    public function cleanText(string $str): string
    {
        // Remove URLS
        $str = preg_replace('@[hw]((ttps?://(www\.)?)|ww\.)([^\s/?.#-]+\.?)+(/\S*)?@i', ' ', $str);
        // Remove emails
        $str = preg_replace('/[a-zA-Z0-9.!$%&’+_`-]+@[A-Za-z0-9.-]+\.[A-Za-z0-9-]{2,64}/u', ' ', $str ?? '');
        // Remove .com domains
        $str = preg_replace('/([A-Za-z0-9-]+\.)+com(\/\S*|[^\pL])/u', ' ', $str ?? '');

        // Remove alphanumerical/number codes
        return preg_replace('/[a-zA-Z]*\d+[a-zA-Z0-9]*+/', ' ', $str ?? '');
    }

    protected function getWords(string $text): array
    {
        $text = mb_strtolower(
            trim(
                substr($text, 0, 1000)
            ),
            'UTF-8'
        );

        // Match words. Treat Chinese, Japanese & Korean logograms as words. Allows non-consecutive apostrophes in words
        preg_match_all(
            '/(?:\pL(?<![\p{Han}\p{Hiragana}\p{Katakana}\p{Hangul}]))+' .
            '(?:[\x27\x60\x{2019}](?:(?![\p{Han}\p{Hiragana}\p{Katakana}\p{Hangul}])\pL)+)*' .
            '|[\p{Han}\p{Hiragana}\p{Katakana}\p{Hangul}]/u',
            $text,
            $words
        );

        return $words[0];
    }

    /**
     * Gets Ngrams from the given words
     */
    protected function getByteNgrams(array $words): array
    {
        /** @var array<string, ?int> $byteNgrams */
        $byteNgrams = [];
        $ngramLength = $this->ngramLength; // Local access is faster
        $ngramStride = $this->ngramStride;
        // $countNgrams = 0;

        foreach ($words as $word) {
            $len = strlen($word);
            // Processing whole-word n-grams separately improves speed measurably
            if ($len <= $ngramLength) {
                // fastest way to set an index key without checking if exist
                $tmp = &$byteNgrams[' ' . $word . ' ']; // $countNgrams++; $tmp++;
            } else {
                $tmp = &$byteNgrams[' ' . substr($word, 0, $ngramLength)]; // $tmp++;
                
                for ($j = $ngramStride; ($j + $ngramLength) < $len; $j += $ngramStride) { // ++$countNgrams, ++$tmp
                    $tmp = &$byteNgrams[substr($word, $j, $ngramLength)];
                }
                $tmp = &$byteNgrams[substr($word, $len - $ngramLength) . ' '];
                // $countNgrams+=2; $tmp++; We would count at least 2 ngrams, start and ending ngram.
            }
            // $tmp++; Unnecessary as long as we do not use $frequency at calculateScores()
            // if ( $countNgrams > 100) { break; } Unnecessary as long as we cut $text at <=1000 bytes
        }

        return $byteNgrams;
    }

    /**
     * Calculate scores from the given Ngrams for each language
     *
     * @param array<string, ?int> $byteNgrams
     * @return non-empty-array<int, float>
     */
    protected function calculateScores(array $byteNgrams): array
    {
        /** @psalm-var non-empty-array<int, float> $langScore */
        $langScore = $this->langScore;

        foreach ($byteNgrams as $bytes => $frequency) {
            if (isset($this->ngrams[$bytes])) {
                // TODO: $frequency (count), not taken into account for now, more testing is needed
                foreach ($this->ngrams[$bytes] as $language => $score) {
                    $langScore[$language] *= $score;
                }
            }
        }

        return $langScore;
    }

    public function enableTextCleanup(bool $bool): void
    {
        $this->textCleanupEnabled = $bool;
    }

    public function info(): array
    {
        return [
            'Database type' => $this->dataType,
            'Language count' => count($this->langCodes),
            'Languages ISO639-1' => $this->langCodes,
            'Output format' => $this->outputFormat,
            'Languages IN output format' =>
                ($this->outputFormat !== EldFormat::ISO639_1 ?
                    array_intersect_key($this->outputLanguages, $this->langCodes) : 'Same as ISO639-1'
                ),
            'Text cleanup enabled' => ($this->textCleanupEnabled ? 'True' : 'False'),
        ];
    }
}
