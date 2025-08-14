<?php
/**
 * @copyright 2024 Nito T.M.
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Nito T.M. (https://github.com/nitotm)
 * @package nitotm/efficient-language-detector
 */

declare(strict_types=1);

namespace Nitotm\Eld;

use InvalidArgumentException;
use RuntimeException;

class LanguageData
{
    use LanguageSubsetTools;

    private static array $fileContents = [];
    /** @var array<string, array<int, float>> $ngrams */
    protected array $ngrams;
    /** @var array<int, float> $avgScore */
    protected array $avgScore;
    /** @var array<int, float> $langScore */
    protected array $langScore;
    /** @var array<int, string> $langCodes */
    protected array $langCodes;
    /** @var array<int, string> $outputLanguages */
    protected array $outputLanguages;
    /** @var null|array<string, array<int, float>> $defaultNgrams */
    protected ?array $defaultNgrams = null;
    protected ?string $loadedSubset = null;
    protected string $ngramsFolder = __DIR__ . '/../resources/ngrams/';
    protected string $dataType;
    protected int $ngramLength;
    protected int $ngramStride;
    protected string $outputFormat;
    // protected bool $isSubset;

    protected function loadData(?string $databaseFile = null, ?string $outputFormat = null): void
    {
        $folder = $this->ngramsFolder;
        // Normalize file name or use default file
        $fileBaseName = ($databaseFile === null ?
            EldDataFile::SMALL
            : preg_replace('/\.php$/', '', strtolower($databaseFile))
        );
        // if file does not exist, check if it's a subset
        if (!file_exists($folder . $fileBaseName . '.php')) {
            $folder .= 'subset/';
            if (!file_exists($folder . $fileBaseName . '.php')) {
                throw new InvalidArgumentException(sprintf('Database file "%s" not found', $fileBaseName));
            }
        }
        // Send warning if OPcache is active and interned_strings_buffer is too low
        InternedWarning::checkAndSend($databaseFile);

        $ngramsData = $this->loadFileContents($folder . $fileBaseName . '.php');
        if (empty($ngramsData['ngrams']) || empty($ngramsData['languages'])) {
            throw new RuntimeException(sprintf('File "%s" data is invalid', $fileBaseName));
        }

        $this->ngrams = $ngramsData['ngrams'];
        $this->langCodes = $ngramsData['languages'];
        $this->dataType = $ngramsData['type'];
        $this->ngramLength = $ngramsData['ngramLength'];
        $this->ngramStride = $ngramsData['ngramStride'];
        // $this->isSubset = $ngramsData['isSubset'];
        $this->avgScore = $ngramsData['avgScore'];
        /** @var int $maxLang Highest language index key */
        /** @psalm-suppress ArgumentTypeCoercion */
        $maxLang = max(array_keys($this->langCodes));
        $this->langScore = array_fill(0, $maxLang + 1, 1.0);

        // Normalize format to avoid case sensitivity issues
        $normalizedFormat = strtoupper($outputFormat ?? EldFormat::ISO639_1);
        $validFormats = [
            EldFormat::ISO639_1,
            EldFormat::ISO639_2T,
            EldFormat::ISO639_1_BCP47,
            EldFormat::ISO639_2T_BCP47,
            EldFormat::FULL_TEXT,
        ];
        if (in_array($normalizedFormat, $validFormats, true)) {
            $this->outputLanguages = $this->loadFileContents(
                __DIR__ . '/../resources/formats/' . strtolower($normalizedFormat) . '.php'
            );
            $this->outputFormat = $normalizedFormat;
        } else {
            throw new InvalidArgumentException("Invalid format: $outputFormat");
        }
    }

    /**
     * Prevent including the same file multiple times
     */
    private function loadFileContents(string $file): array
    {
        return self::$fileContents[$file] ?? (self::$fileContents[$file] = require $file);
    }
}
