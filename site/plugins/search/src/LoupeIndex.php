<?php

namespace Kirby\Search;

/**
 * Handles Loupe search index operations
 * Manages document indexing and SQLite database creation
 *
 * @package   Kirby Search
 * @author    Ahmet Bora <ahmet@getkirby.com>,
 *            Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
class LoupeIndex extends Index
{
	/**
	 * @var \Kirby\Search\LoupeSearch
	 */
	protected Search $search;

    /**
     * Generate the complete search index
     * This will create/replace the SQLite database
     */
    public function generate(): void
    {
        $this->search->loupe->deleteAllDocuments();

        $documents = [];

        foreach ($this->entries() as $entry) {
            $documents[] = $entry->toData();

			if (count($documents) % 200 === 0) {
				$this->search->loupe->addDocuments($documents);
				$documents = [];
			}
        }
    }
}
