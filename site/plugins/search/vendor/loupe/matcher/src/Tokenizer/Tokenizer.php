<?php

declare(strict_types=1);

namespace Loupe\Matcher\Tokenizer;

class Tokenizer implements TokenizerInterface
{
    public function __construct(
        private ?string $locale = null
    ) {

    }

    public function matches(Token $token, TokenCollection $tokens): bool
    {
        foreach ($tokens->all() as $checkToken) {
            foreach ($checkToken->allTerms() as $checkTerm) {
                if (\in_array($checkTerm, $token->allTerms(), true)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function tokenize(string $string, ?int $maxTokens = null): TokenCollection
    {
        $iterator = \IntlRuleBasedBreakIterator::createWordInstance($this->locale); // @phpstan-ignore-line - null is allowed
        $iterator->setText($string);

        $tokens = new TokenCollection();
        $id = 0;
        $position = 0;
        $phrase = false;
        $negated = false;
        $whitespace = true;

        foreach ($iterator->getPartsIterator() as $term) {
            // Set negation if the previous token was not a word and we're not in a phrase
            if (!$phrase && $whitespace) {
                $negated = false;
                if ($term === '-') {
                    $negated = true;
                }
            }

            // Toggle phrases between quotes
            if ($term === '"') {
                $phrase = !$phrase;
                if (!$phrase) {
                    $negated = false;
                }
            }

            $status = $iterator->getRuleStatus();
            $word = $this->isWord($status);
            $whitespace = $this->isWhitespace($status, $term);

            if (!$word) {
                $position += mb_strlen($term, 'UTF-8');
                continue;
            }

            if ($maxTokens !== null && $tokens->count() >= $maxTokens) {
                break;
            }

            $term = mb_strtolower($term, 'UTF-8');

            $token = new Token(
                $id++,
                $term,
                $position,
                $phrase,
                $negated,
            );

            $position += $token->getLength();
            $tokens->add($token);
        }

        return $tokens;
    }

    private function isWhitespace(?int $status, string $token): bool
    {
        return ($status === null || ($status >= \IntlBreakIterator::WORD_NONE && $status < \IntlBreakIterator::WORD_NONE_LIMIT)) && trim($token) === '';
    }

    private function isWord(?int $status): bool
    {
        return $status >= \IntlBreakIterator::WORD_NONE_LIMIT;
    }
}
