<?php

namespace Kirby\Search;

use Kirby\Cms\Pagination;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;

/**
 * Search results collection with pagination support
 * Wraps Loupe search results in Kirby-compatible format
 *
 * @author Your Name
 * @license MIT
 */
class Results extends Collection
{
    /**
     * Create Results from Loupe search response
     */
    public static function from(array $response, int $page = 1, int $limit = 20): static
    {
        // Convert hits to Obj objects
        $hits = A::map($response['hits'] ?? [], fn($hit) => new Obj($hit));
        $results = new static($hits);

        // Create pagination from Loupe response
        $results->pagination = new Pagination([
            'page'  => $page,
            'total' => $response['totalHits'] ?? 0,
            'limit' => $limit,
        ]);

        return $results;
    }
}
