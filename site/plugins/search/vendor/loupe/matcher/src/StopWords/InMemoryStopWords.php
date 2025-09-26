<?php

declare(strict_types=1);

namespace Loupe\Matcher\StopWords;

use Loupe\Matcher\Tokenizer\Token;

class InMemoryStopWords implements StopWordsInterface
{
    /**
     * @param array<string> $stopWords
     */
    public function __construct(
        private array $stopWords = []
    ) {

    }

    public function isStopWord(Token $token): bool
    {
        return \in_array($token->getTerm(), $this->stopWords, true);
    }
}
