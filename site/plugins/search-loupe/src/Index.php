<?php

namespace Kirby\Search\Loupe;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Loupe\Loupe\Configuration;
use Loupe\Loupe\Loupe;
use Loupe\Loupe\LoupeFactory;

/**
 * Handles Loupe search index operations
 * Manages document indexing and SQLite database creation
 *
 * @package   Kirby Loupe
 * @author    Ahmet Bora <ahmet@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://getkirby.com/license
 */
class Index
{
    protected Pages $entries;
    protected Loupe $loupe;

    public function __construct(protected Search $search)
    {
        $this->initializeLoupe();
    }

    /**
     * Initialize Loupe client with configuration
     */
    protected function initializeLoupe(): void
    {
        $config = Configuration::create()
            ->withPrimaryKey($this->search->options['primary_key'] ?? 'id')
            ->withSearchableAttributes($this->search->options['searchable_attributes'] ?? ['*'])
            ->withFilterableAttributes($this->search->options['filterable_attributes'] ?? [])
            ->withSortableAttributes($this->search->options['sortable_attributes'] ?? []);

        $factory = new LoupeFactory();
        $this->loupe = $factory->create(
            $this->search->options['database_path'] ?? kirby()->root('storage') . '/loupe',
            $config
        );
    }

    /**
     * Get all indexable pages as entries
     */
    protected function entries(): Pages
    {
        return $this->entries ??= App::instance()
            ->site()
            ->index()
            ->map(fn(Page $page) => new Entry($page, $this->search))
            ->filter(fn(Entry $entry) => $entry->isIndexable());
    }

    /**
     * Generate the complete search index
     * This will create/replace the SQLite database
     */
    public function generate(): void
    {
        // Delete all existing documents
        $this->loupe->deleteAllDocuments();

        // Get all entries and convert to documents array
        $entries = $this->entries();
        $documents = [];

        foreach ($entries as $entry) {
            $documents[] = $entry->toData();
        }

        // Add documents to Loupe in batches
        if (!empty($documents)) {
            $this->loupe->addDocuments($documents);
        }
    }

    /**
     * Get the number of indexable entries
     */
    public function count(): int
    {
        return $this->entries()->count();
    }

    /**
     * Get the Loupe client instance
     */
    public function loupe(): Loupe
    {
        return $this->loupe;
    }
}
