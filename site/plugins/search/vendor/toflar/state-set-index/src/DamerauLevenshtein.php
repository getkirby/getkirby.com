<?php

namespace Toflar\StateSetIndex;

class DamerauLevenshtein
{
    /**
     * Damerau-Levenshtein distance algorithm optimized for a specified maximum.
     *
     * We only use a diagonal corridor of the full matrix, the top right and
     * bottom left area is ignored as they would always be guaranteed to reach
     * the maximum.
     *
     * For a maximum distance of 2, the matrix looks like this and the algorithm
     * would return early with a distance of 2 after calculating row d:
     *
     * ```
     *       a, c, e, d, f, g, h
     *  : 0, 1,  ,  ,  ,  ,  ,
     * a: 1, 0, 1,  ,  ,  ,  ,
     * b:  , 1, 1, 2,  ,  ,  ,
     * c:  ,  , 1, 2, 3,  ,  ,
     * d:  ,  ,  , 2, 2, 3,  ,
     * e:  ,  ,  ,  , 2, 3, 3,
     * f:  ,  ,  ,  ,  , 2, 3, 3
     * g:  ,  ,  ,  ,  ,  , 2, 3
     * ```
     */
    public static function distance(string $string1, string $string2, int $maxDistance = PHP_INT_MAX, int $insertionCost = 1, int $replacementCost = 1, int $deletionCost = 1, int $transpositionCost = 1): int
    {
        if ($insertionCost < 1 || $replacementCost < 1 || $deletionCost < 1 || $transpositionCost < 1) {
            throw new \InvalidArgumentException('Cost values below 1 are not supported');
        }

        // Strip common prefix
        $xorLeft = $string1 ^ $string2;
        if ($commonPrefixLength = strspn($xorLeft, "\0")) {
            $string1 = mb_strcut($string1, $commonPrefixLength);
            $string2 = mb_strcut($string2, $commonPrefixLength);
        }

        // Strip common suffix
        $xorRight = substr($string1, -\strlen($string2)) ^ substr($string2, -\strlen($string1));
        if ($commonSuffixLength = \strlen($xorRight) - \strlen(rtrim($xorRight, "\0"))) {
            $suffix = mb_strcut($string1, -$commonSuffixLength);
            if (\strlen($suffix) > $commonSuffixLength) {
                $suffix = mb_substr($suffix, 1);
            }
            $string1 = substr($string1, 0, -\strlen($suffix) ?: null);
            $string2 = substr($string2, 0, -\strlen($suffix) ?: null);
        }

        $chars1 = mb_str_split($string1);
        $chars2 = mb_str_split($string2);
        $string1Length = \count($chars1);
        $string2Length = \count($chars2);

        if ($string1Length === 0) {
            return min($maxDistance, $string2Length * $insertionCost);
        }

        if ($string2Length === 0) {
            return min($maxDistance, $string1Length * $deletionCost);
        }

        // Distance can never be higher than deleting string1 and inserting string2
        $maxDistance = min($maxDistance, $string1Length * $deletionCost + $string2Length * $insertionCost);

        $requiredDeletions = max(0, $string1Length - $string2Length);
        $requiredInsertions = max(0, $string2Length - $string1Length);

        // Distance required to bring both strings to the same length
        $lengthDistance = $requiredInsertions * $insertionCost + $requiredDeletions * $deletionCost;

        // Length difference is too big
        if ($maxDistance <= $lengthDistance) {
            return $maxDistance;
        }

        // After length correction, how many deletion/insertion pairs are maximally possible
        $maxDeletionInsertionPairs = max(0, floor(($maxDistance - $lengthDistance) / ($deletionCost + $insertionCost)));

        $maxDeletions = $requiredDeletions + $maxDeletionInsertionPairs;
        $maxInsertions = $requiredInsertions + $maxDeletionInsertionPairs;
        $matrixSize = 1 + $maxDeletions + $maxInsertions;

        // We only store the latest two rows and flip the access between them.
        $matrix = [
            array_fill(0, $matrixSize, $maxDistance),
            array_fill(0, $matrixSize, $maxDistance),
        ];

        // Fill the row before the first one starting with 0
        for ($i = $maxDeletions; $i < $matrixSize; ++$i) {
            $matrix[0][$i] = ($i - $maxDeletions) * $insertionCost;
        }

        // Iterate through string1 (rows)
        for ($i = 0; $i < $string1Length; ++$i) {
            $currentRow = ($i + 1) % 2;
            $lastRow = $i % 2;

            // Iterate through string2 (columns)
            for ($j = 0; $j < $matrixSize; ++$j) {
                $col = $j - $maxDeletions + $i;

                // Fill the column before the first one starting with 0
                if ($col < 0) {
                    $matrix[$currentRow][$j] = ($i - $col) * $deletionCost;
                    continue;
                }

                if ($col >= $string2Length) {
                    continue;
                }

                if ($i && ($chars1[$i] ?? '') === ($chars2[$col - 1] ?? '') && ($chars1[$i - 1] ?? '') === ($chars2[$col] ?? '')) {
                    // In this case $matrix[$currentRow][$j] refers to the value
                    // two rows above and two columns to the left in the matrix.
                    $transpositioned = $matrix[$currentRow][$j] + $transpositionCost;
                } else {
                    $transpositioned = $maxDistance;
                }

                $matrix[$currentRow][$j] = min(
                    $transpositioned,
                    ($matrix[$lastRow][$j + 1] ?? $maxDistance) + $deletionCost,
                    ($matrix[$currentRow][$j - 1] ?? $maxDistance) + $insertionCost,
                    ($matrix[$lastRow][$j] ?? $maxDistance) + ((($chars1[$i] ?? '') === ($chars2[$col] ?? '')) ? 0 : $replacementCost),
                );
            }

            if (min($matrix[$currentRow]) >= $maxDistance && min($matrix[$lastRow]) + $transpositionCost >= $maxDistance) {
                return $maxDistance;
            }
        }

        // Return the distance value found in the last row in the last column
        return min($maxDistance, $matrix[$currentRow ?? 0][$maxDeletions - ($string1Length - $string2Length)]);
    }
}
