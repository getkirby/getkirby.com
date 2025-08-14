<?php

namespace Toflar\StateSetIndex\DataStore;

interface DataStoreInterface
{
    public function add(int $state, string $string): void;

    /**
     * Returns the matching strings per state. Key is the state and the value is an array of matching strings
     * for that state.
     *
     * @return array<int,array<string>>
     */
    public function getForStates(array $states = []): array;

    public function remove(int $state, string $string): void;
}
