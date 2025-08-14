<?php

declare(strict_types=1);

namespace Loupe\Matcher\Tokenizer;

class Phrase extends TokenCollection
{
    /**
     * @param array<Token> $tokens
     */
    public function __construct(
        array $tokens,
        private bool $isNegated
    ) {
        parent::__construct($tokens);
    }

    public function isNegated(): bool
    {
        return $this->isNegated;
    }
}
