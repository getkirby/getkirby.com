<?php

declare(strict_types=1);

namespace Loupe\Matcher\Tokenizer;

interface TokenizerInterface
{
    public function matches(Token $token, TokenCollection $tokens): bool;

    public function tokenize(string $string, ?int $maxTokens = null): TokenCollection;
}
