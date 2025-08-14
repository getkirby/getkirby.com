<?php

namespace Toflar\StateSetIndex\DataStore;

class NullDataStore implements DataStoreInterface
{
    public function add(int $state, string $string): void
    {
        // noop
    }

    public function getForStates(array $states = []): array
    {
        return [];
    }

    public function remove(int $state, string $string): void
    {
        // noop
    }
}
