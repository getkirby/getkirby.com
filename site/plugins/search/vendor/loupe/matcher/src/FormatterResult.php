<?php

declare(strict_types=1);

namespace Loupe\Matcher;

use Loupe\Matcher\Tokenizer\Token;
use Loupe\Matcher\Tokenizer\TokenCollection;

class FormatterResult
{
    public function __construct(
        private string $formattedText,
        private TokenCollection $matches
    ) {
    }

    public function getFormattedText(): string
    {
        return $this->formattedText;
    }

    public function getMatches(): TokenCollection
    {
        return $this->matches;
    }

    /**
     * @return array<int, array{start: int, length: int}>
     */
    public function getMatchesArray(): array
    {
        return array_map(fn (Token $token) => [
            'start' => $token->getStartPosition(),
            'length' => $token->getLength(),
        ], $this->matches->all());
    }

    public function hasMatches(): bool
    {
        return $this->matches->count() > 0;
    }
}
