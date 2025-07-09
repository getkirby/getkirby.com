<?php

namespace Kirby\Search;

use Exception;
use Kirby\Cms\App;
use Loupe\Loupe\SearchParameters;

/**
 * Main Search class for Loupe integration
 *  Provides an interface for indexing and searching documents
 *
 * @author Your Name
 * @license MIT
 */
class Search
{
    public static Search $instance;
    public Index         $index;
    public array         $options = [];

    public function __construct()
    {
        $this->options = App::instance()->option('search.loupe', []);

        // Validate configuration
        if (empty($this->options)) {
            throw new Exception('Please configure the Loupe search plugin in your Kirby configuration.');
        }

        // Set default database path if not provided
        if (!isset($this->options['database_path'])) {
            $this->options['database_path'] = kirby()->root('storage') . '/loupe.sqlite';
        }
    }

    /**
     * Get the index instance
     */
    public function index(): Index
    {
        return $this->index ??= new Index($this);
    }

    /**
     * Get singleton instance
     */
    public static function instance(): static
    {
        return static::$instance ??= new static();
    }

    /**
     * Perform a search query
     */
    public function query(
        string $query = null,
        int    $page = 1,
        array  $options = []
    ): Results
    {
        if (empty($query)) {
            return Results::from([], $page, $options['limit'] ?? 20);
        }

        $limit = $options['limit'] ?? 20;

        // Create search parameters
        $searchParams = SearchParameters::create()
            ->withQuery($query)
            ->withHitsPerPage($limit)
            ->withPage($page);

        // Add filters if provided
        if (!empty($options['filter'])) {
            $searchParams = $searchParams->withFilter($options['filter']);
        }

        // Add attributes to retrieve if specified
        if (!empty($options['attributes_to_retrieve'])) {
            $searchParams = $searchParams->withAttributesToRetrieve($options['attributes_to_retrieve']);
        }

        // Perform search using Loupe
        $loupeResults = $this->index()->loupe()->search($searchParams);

        // Convert to our Results format
        return Results::from($loupeResults->toArray(), $page, $limit);
    }
}
