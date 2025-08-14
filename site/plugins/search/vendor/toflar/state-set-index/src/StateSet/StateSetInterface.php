<?php

namespace Toflar\StateSetIndex\StateSet;

interface StateSetInterface
{
    public function add(int $state): void;

    /**
     * @return array<int>
     */
    public function all(): array;

    public function has(int $state): bool;

    public function remove(int $state): void;
}
