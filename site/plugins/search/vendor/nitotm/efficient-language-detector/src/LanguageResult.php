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
final class LanguageResult
{
    public string $language; // TODO make it readonly when we upgrade to PHP +8.1
    private int $languageId;
    /** @var array<int, float> $rawScores */
    private array $rawScores;
    /** @var array<string, ?int> $byteNgrams */
    private array $byteNgrams;
    /** @var null|array<string, float> $prettyScores */
    private ?array $prettyScores;
    /** @var array<int, string> $outputLanguages */
    private array $outputLanguages;
    /** @var array<int, float> $avgScore */
    private array $avgScore;


    /**
     * @param array<int, float> $rawScores
     * @param array<string, ?int> $byteNgrams
     * @param array<int, string> $outputLanguages
     * @param array<int, float> $avgScore
     */
    public function __construct(
        ?int $languageId = null,
        array $rawScores = [],
        array $byteNgrams = [],
        array $outputLanguages = [],
        array $avgScore = []
    ) {
        if ($languageId !== null) {
            $this->languageId = $languageId;
            $this->language = $outputLanguages[$this->languageId];
            $this->rawScores = $rawScores;
            $this->byteNgrams = $byteNgrams;
            $this->outputLanguages = $outputLanguages;
            $this->avgScore = $avgScore;
        } else {
            $this->language = 'und';
        }
    }

    public function __debugInfo()
    {
        return [
            'language' => $this->language,
            'scores()' => $this->scores(),
            'isReliable()' => $this->isReliable()
        ];
    }

    public function scores(): array
    {
        if (isset($this->prettyScores)) {
            return $this->prettyScores;
        }
        $scores = [];
        if ($this->language !== 'und') {
            $outputLanguages = $this->outputLanguages; // local access improves speed. Tested on PHP 7.4 & 8.2
            $fraction = 1 / count($this->byteNgrams);
            foreach ($this->rawScores as $key => $value) {
                if ($value > 1) {
                    // we get avg. score per ngram, then normalize score value to 0-1
                    $scores[$outputLanguages[$key]] = 1 - 1 / exp($fraction * log($value));
                }
            }
            arsort($scores);
        }

        return $this->prettyScores = $scores;
    }

    public function isReliable(): bool
    {
        // if undetermined language, or less than 3 ngrams
        if ($this->language === 'und' || count($this->byteNgrams) < 3) {
            return false;
        }
        /** @var array<string, float> $scores */
        $scores = $this->scores();
        reset($scores); // Make sure the pointer is at the beginning

        // Is reliable if score is >75% of average, and +5% higher than next score. Selected numbers after testing
        if ($this->avgScore[$this->languageId] * 0.75 > $scores[$this->language]
            || 0.05 > abs($scores[$this->language] - next($scores)) / $scores[$this->language]) {
            return false;
        }

        return true;
    }
}
