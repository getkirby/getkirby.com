<?php

namespace Kirby\Search;

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
    static public function from(array $response): static
    {
        // Convert the hits to Obj objects
        $results = new static(array_map(
            fn ($hit) => new Obj($hit),
            $response['hits']
        ));

        $results->pagination = new Pagination([
            'page'  => ($response['page'] ?? 0) + 1,
            'total' => $response['nbHits'] ?? 0,
            'limit' => $response['hitsPerPage'] ?? 20,
        ]);

        return $results;
    }
}
