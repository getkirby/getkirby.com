<?php

namespace Toflar\StateSetIndex;

use Toflar\StateSetIndex\Alphabet\AlphabetInterface;
use Toflar\StateSetIndex\DataStore\DataStoreInterface;
use Toflar\StateSetIndex\StateSet\CostAnnotatedStateSet;
use Toflar\StateSetIndex\StateSet\StateSetInterface;

class StateSetIndex
{
    /**
     * @var array<string, int>
     */
    private array $indexCache = [];

    /**
     * @var array<string, int>
     */
    private array $matchingStatesCache = [];

    public function __construct(
        private Config $config,
        private AlphabetInterface $alphabet,
        public StateSetInterface $stateSet,
        private DataStoreInterface $dataStore,
    ) {
    }

    /**
     * Returns the matching strings.
     *
     * @return array<string>
     */
    public function find(string $string, int $editDistance, int $transpositionCost = 1): array
    {
        $acceptedStringsPerState = $this->findAcceptedStrings($string, $editDistance, $transpositionCost);
        $stringLength = mb_strlen($string);
        $filtered = [];

        foreach ($acceptedStringsPerState as $acceptedStrings) {
            foreach ($acceptedStrings as $acceptedString) {
                // Early aborts (cheaper) for cases we know are absolutely never going to match
                if (abs($stringLength - mb_strlen($acceptedString)) > $editDistance) {
                    continue;
                }

                if (DamerauLevenshtein::distance($string, $acceptedString, $editDistance + 1, 1, 1, 1, $transpositionCost) <= $editDistance) {
                    $filtered[] = $acceptedString;
                }
            }
        }

        return array_unique($filtered);
    }

    /**
     * Returns the matching strings per state. Key is the state and the value is an array of matching strings
     * for that state.
     *
     * @return array<int,array<string>>
     */
    public function findAcceptedStrings(string $string, int $editDistance, int $transpositionCost): array
    {
        return $this->dataStore->getForStates($this->findMatchingStates($string, $editDistance, $transpositionCost));
    }

    /**
     * Returns the matching states.
     *
     * @return array<int>
     */
    public function findMatchingStates(string $string, int $editDistance, int $transpositionCost): array
    {
        $cacheKey = $string . ';' . $editDistance . ';' . $transpositionCost;

        // Seen this already, skip
        if (isset($this->matchingStatesCache[$cacheKey])) {
            return $this->matchingStatesCache[$cacheKey];
        }

        $indexLength = $this->config->getIndexLength();
        $alphabetSize = $this->config->getAlphabetSize();

        // Calculate the lower bound of all possible states that reach the index length
        $cutOffLowerBound = PHP_INT_MAX;
        if (mb_strlen($string) > $indexLength - $editDistance) {
            $cutOffLowerBound = 0;
            for ($i = 1; $i < $indexLength; ++$i) {
                $cutOffLowerBound = $cutOffLowerBound * $alphabetSize + $alphabetSize;
            }
        }

        // Initial states
        $states = $this->getReachableStates($alphabetSize, 0, $editDistance);
        $lastSubstitutions = [];
        $lastMappedChar = null;

        $this->loopOverEveryCharacter($indexLength, $alphabetSize, $string, function (int $mappedChar) use (&$states, &$lastSubstitutions, &$lastMappedChar, $editDistance, $transpositionCost, $alphabetSize, $cutOffLowerBound) {
            $statesStar = new CostAnnotatedStateSet(); // This is S∗ in the paper
            $substitutionStates = [];

            foreach ($states->all() as $state => $cost) {
                $statesStarC = new CostAnnotatedStateSet(); // This is S∗c in the paper

                // Match for characters that got cut off during indexing because they appear past the index length
                if ($state > $cutOffLowerBound) {
                    $statesStarC->add($state, $cost);
                }

                // Deletion
                if ($cost + 1 <= $editDistance) {
                    $statesStarC->add($state, $cost + 1);
                }

                // Match & Substitution
                for ($i = 1; $i <= $alphabetSize; $i++) {
                    $newState = (int) ($state * $alphabetSize + $i);

                    if ($i === $mappedChar) {
                        if ($this->stateSet->has($newState)) {
                            // Match
                            $statesStarC->add($newState, $cost);
                        }
                    } elseif ($cost + 1 <= $editDistance) {
                        if ($this->stateSet->has($newState)) {
                            // Substitution
                            $statesStarC->add($newState, $cost + 1);
                            $substitutionStates[$i] ??= new CostAnnotatedStateSet();
                            $substitutionStates[$i]->add($newState, $cost + 1);
                        }
                    }
                }

                // Insertion
                foreach ($statesStarC->all() as $newState => $newCost) {
                    $statesStar = $statesStar->mergeWith($this->getReachableStates(
                        $alphabetSize,
                        $newState,
                        $editDistance,
                        $newCost
                    ));
                }
            }

            // Transposition
            // Takes all substitution states from the previous step that matched
            // the current char and adds a followup substitution state using the
            // previous char and assigns a combined cost of $transpositionCost.
            foreach (($lastSubstitutions[$mappedChar] ?? null)?->all() ?? [] as $state => $cost) {
                $newState = (int) ($state * $alphabetSize + $lastMappedChar);

                if ($this->stateSet->has($newState)) {
                    $statesStar = $statesStar->mergeWith($this->getReachableStates(
                        $alphabetSize,
                        $newState,
                        $editDistance,
                        $cost - 1 + $transpositionCost,
                    ));
                }
            }

            $states = $statesStar;
            $lastMappedChar = $mappedChar;
            $lastSubstitutions = $substitutionStates;
        });

        return $this->matchingStatesCache[$cacheKey] = $states->states();
    }

    public function getAlphabet(): AlphabetInterface
    {
        return $this->alphabet;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function getStateSet(): StateSetInterface
    {
        return $this->stateSet;
    }

    /**
     * Indexes an array of strings and returns an array where all strings have their state assigned.
     *
     * @return array<string, int>
     */
    public function index(array $strings): array
    {
        $assigned = [];
        $indexLength = $this->config->getIndexLength();
        $alphabetSize = $this->config->getAlphabetSize();

        foreach ($strings as $string) {
            // Seen this already, skip
            if (isset($this->indexCache[$string])) {
                $assigned[$string] = $this->indexCache[$string];
                continue;
            }

            $state = 0;
            $this->loopOverEveryCharacter($indexLength, $alphabetSize, $string, function (int $mappedChar) use (&$state, $alphabetSize) {
                $newState = (int) ($state * $alphabetSize + $mappedChar);

                $this->stateSet->add($newState);
                $state = $newState;
            });

            $assigned[$string] = $this->indexCache[$string] = $state;
            $this->dataStore->add($state, $string);
        }

        return $assigned;
    }

    /**
     * Removes an array of strings from the index.
     */
    public function removeFromIndex(array $strings): void
    {
        $indexLength = $this->config->getIndexLength();
        $alphabetSize = $this->config->getAlphabetSize();

        foreach ($strings as $string) {
            unset($this->indexCache[$string]);

            $states = [];
            $state = 0;
            $this->loopOverEveryCharacter($indexLength, $alphabetSize, $string, function (int $mappedChar) use (&$state, &$states, $alphabetSize) {
                $states[] = $state = (int) ($state * $alphabetSize + $mappedChar);
            });

            $this->dataStore->remove($state, $string);

            foreach (array_reverse($states) as $state) {
                // If a state is shared with another string or a state exists that follows the current one we must stop
                // the removal process as all previous states and the current one must be kept.
                if (isset($this->dataStore->getForStates([$state])[$state]) || $this->hasNextState($state, $alphabetSize)) {
                    continue 2;
                }

                $this->stateSet->remove($state);
            }
        }
    }

    private function getReachableStates(int $alphabetSize, int $startState, int $editDistance, int $currentDistance = 0): CostAnnotatedStateSet
    {
        $reachable = new CostAnnotatedStateSet();

        if ($currentDistance > $editDistance) {
            return $reachable;
        }

        // A state is always able to reach itself
        $reachable->add($startState, $currentDistance);

        if ($currentDistance >= $editDistance) {
            return $reachable;
        }

        for ($c = 1; $c <= $alphabetSize; $c++) {
            $state = $startState * $alphabetSize + $c;
            if ($this->stateSet->has($state)) {
                $reachable = $reachable->mergeWith($this->getReachableStates($alphabetSize, $state, $editDistance, $currentDistance + 1));
            }
        }

        return $reachable;
    }

    /**
     * Returns true if a state exists that follows the given state
     */
    private function hasNextState(int $state, int $alphabetSize): bool
    {
        for ($c = 1; $c <= $alphabetSize; ++$c) {
            if ($this->stateSet->has($state * $alphabetSize + $c)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Closure(int) $closure
     */
    private function loopOverEveryCharacter(int $indexLength, int $alphabetSize, string $string, \Closure $closure): void
    {
        $indexedSubstringLength = min($indexLength, mb_strlen($string));
        $indexedSubstring = mb_substr($string, 0, $indexedSubstringLength);

        foreach (mb_str_split($indexedSubstring) as $char) {
            $mappedChar = $this->alphabet->map($char, $alphabetSize);
            $closure($mappedChar);
        }
    }
}
