<?php

namespace Toflar\StateSetIndex\Alphabet;

interface AlphabetInterface
{
    /**
     * Maps a character to its internal label value.
     */
    public function map(string $char, int $alphabetSize): int;
}
