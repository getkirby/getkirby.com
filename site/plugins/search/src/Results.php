<?php

namespace Kirby\Search;

// Kirby dependencies
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;
use Kirby\Cms\Pagination;

/**
 * Kirby Search Results
 *
 * @author Nico Hoffmann <nico@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Results extends Collection
{

    static public function from(array $response): self
    {
        // Convert the hits to Obj objects
        $hits = array_map(function ($hit) {
            return new Obj($hit);
        }, $response['hits']);

        $results = new static($hits);
        $results->pagination = new Pagination([
            'page'  => ($response['page'] ?? 0) + 1,
            'total' => $response['nbHits'] ?? 0,
            'limit' => $response['hitsPerPage'] ?? 20,
        ]);

        return $results;
    }
}
