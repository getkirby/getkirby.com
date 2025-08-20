<?php

namespace Toflar\StateSetIndex;

class Config
{
    public function __construct(
        private int $indexLength,
        private int $alphabetSize
    ) {
    }

    public function getAlphabetSize(): int
    {
        return $this->alphabetSize;
    }

    public function getIndexLength(): int
    {
        return $this->indexLength;
    }
}
