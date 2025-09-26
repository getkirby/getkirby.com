<?php

namespace Toflar\StateSetIndex\Alphabet;

class InMemoryAlphabet implements AlphabetInterface
{
    /**
     * The alphabet consists of a char as key and associated integer as label/value.
     *
     * @param array<string, int> $alphabet
     */
    public function __construct(
        private array $alphabet = []
    ) {
    }

    public function add(string $char, int $label): self
    {
        $this->alphabet[$char] = $label;

        return $this;
    }

    public function all(): array
    {
        return $this->alphabet;
    }

    public function count(): int
    {
        return \count($this->alphabet);
    }

    public function get(string $char): ?int
    {
        return $this->alphabet[$char] ?? null;
    }

    public function has(string $char): bool
    {
        return isset($this->alphabet[$char]);
    }

    public function map(string $char, int $alphabetSize): int
    {
        if ($this->has($char)) {
            return $this->get($char);
        }

        $newLabel = $this->count() % $alphabetSize + 1;
        $this->add($char, $newLabel);

        return $newLabel;
    }
}
