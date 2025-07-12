<?php

declare(strict_types=1);

namespace Loupe\Matcher;

use Loupe\Matcher\Tokenizer\Span;
use Loupe\Matcher\Tokenizer\TokenCollection;
use Loupe\Matcher\Tokenizer\TokenizerInterface;

class Matcher
{
    /**
     * @param array<string> $stopWords
     */
    public function __construct(
        private TokenizerInterface $tokenizer,
        private array $stopWords = []
    ) {
    }

    public function calculateMatches(TokenCollection|string $text, TokenCollection|string $query): TokenCollection
    {
        if ($text === '') {
            return new TokenCollection();
        }

        $textTokens = $text instanceof TokenCollection ? $text : $this->tokenizer->tokenize($text, stopWords: $this->stopWords, includeStopWords: true);
        $queryTokens = $query instanceof TokenCollection ? $query : $this->tokenizer->tokenize($query);

        $matches = new TokenCollection();
        foreach ($textTokens->all() as $textToken) {
            if ($this->tokenizer->matches($textToken, $queryTokens)) {
                $matches->add($textToken);
            }
        }

        return $matches;
    }

    /**
     * @return Span[]
     */
    public function calculateMatchSpans(TokenCollection $matches): array
    {
        $matches = $this->removeSolitaryStopWords($matches);

        $spans = [];
        $prevMatch = null;

        foreach ($matches->all() as $match) {
            // Merge matches that are exactly after one another
            $prevSpan = end($spans);
            if ($prevSpan && $prevMatch && $prevMatch->getEndPosition() === $match->getStartPosition() - 1) {
                array_splice($spans, -1, 1, [$prevSpan->withEndPosition($match->getEndPosition())]);
            } else {
                $spans[] = new Span($match->getStartPosition(), $match->getEndPosition());
            }

            $prevMatch = $match;
        }

        return $spans;
    }

    private function removeSolitaryStopWords(TokenCollection $matches): TokenCollection
    {
        $maxCharDistance = 1;
        $maxWordDistance = 1;

        $result = new TokenCollection();

        foreach ($matches->all() as $i => $match) {
            if (!$match->isStopWord()) {
                $result->add($match);
                continue;
            }

            $hasNonStopWordNeighbor = false;

            for ($j = 1; $j <= $maxWordDistance; $j++) {
                $prevMatch = $matches->atIndex($i - $j);
                $nextMatch = $matches->atIndex($i + $j);

                // Keep stopword matches between non-stopword matches of interest
                $hasNonStopWordNeighbor = ($prevMatch && !$prevMatch->isStopWord() && $prevMatch->getEndPosition() >= $match->getStartPosition() - $maxCharDistance)
                    || ($nextMatch && !$nextMatch->isStopWord() && $nextMatch->getStartPosition() <= $match->getEndPosition() + $maxCharDistance);

                if ($hasNonStopWordNeighbor) {
                    break;
                }
            }

            if ($hasNonStopWordNeighbor) {
                $result->add($match);
            }
        }

        return $result;
    }
}
