<?php

namespace Toflar\StateSetIndex\StateSet;

class InMemoryStateSet implements StateSetInterface
{
    /**
     * @param array $states array<int, bool>
     */
    public function __construct(
        private array $states = []
    ) {
    }

    public function add(int $state): void
    {
        $this->states[$state] = true;
    }

    public function all(): array
    {
        return array_keys($this->states);
    }

    public function has(int $state): bool
    {
        return isset($this->states[$state]);
    }

    public function remove(int $state): void
    {
        unset($this->states[$state]);
    }
}
