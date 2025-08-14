<?php

declare(strict_types=1);

namespace Loupe\Matcher\Tokenizer;

class Span
{
    public function __construct(
        private int $startPosition,
        private int $endPosition,
    ) {
    }

    public function getEndPosition(): int
    {
        return $this->endPosition;
    }

    public function getLength(): int
    {
        return $this->endPosition - $this->startPosition;
    }

    public function getStartPosition(): int
    {
        return $this->startPosition;
    }

    public function withEndPosition(int $endPosition): self
    {
        return new self($this->startPosition, $endPosition);
    }
}
