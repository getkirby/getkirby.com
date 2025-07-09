<?php

namespace Toflar\StateSetIndex\StateSet;

class CostAnnotatedStateSet
{
    /**
     * Key: State
     * Value: Cost
     * @var array<int, int>
     */
    private array $set = [];

    /**
     * Adds a state with a cost to this set.
     * If this sets already contains the given state with a higher cost, replaces it.
     */
    public function add(int $state, int $cost): void
    {
        if (!isset($this->set[$state])) {
            $this->set[$state] = $cost;
            return;
        }

        // Lowest cost always wins
        if ($cost < $this->set[$state]) {
            $this->set[$state] = $cost;
        }
    }

    /**
     * Key: State
     * Value: Cost
     * @return array<int, int>
     */
    public function all(): array
    {
        return $this->set;
    }

    public function mergeWith(CostAnnotatedStateSet $stateSet): self
    {
        $clone = clone $this;

        foreach ($stateSet->all() as $state => $cost) {
            $clone->add($state, $cost);
        }

        return $clone;
    }

    public function states(): array
    {
        $states = array_values(array_keys($this->set));
        sort($states);
        return $states;
    }
}
