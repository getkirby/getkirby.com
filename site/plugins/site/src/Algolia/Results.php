<?php

namespace Kirby\Algolia;

// Kirby dependencies
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;
use Kirby\Cms\Pagination;

/**
 * Kirby Algolia Results Class
 *
 * @author Lukas Bestle <lukas@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Results extends Collection
{

    // Result metadata
    protected $totalCount;
    protected $processingTime;
    protected $searchQuery;
    protected $params;

    /**
     * Class constructor
     *
     * @param array $results Returned data from an Algolia search operation
     */
    public function __construct ($results)
    {
        // Defaults in case the results are invalid
        $defaults = [
            'hits'             => [],
            'page'             => 0,
            'nbHits'           => 0,
            'nbPages'          => 0,
            'hitsPerPage'      => 20,
            'processingTimeMS' => 0,
            'query'            => '',
            'params'           => ''
        ];

        $results = array_merge($defaults, $results);

        // Convert the hits to Obj objects
        $hits = array_map(function ($hit) {
            return new Obj($hit);
        }, $results['hits']);

        // Get metadata from the results
        // Algolia uses zero based page indexes while Kirby's pagination starts at 1
        $page           = $results['page'] + 1;
        $totalCount     = $results['nbHits'];
        $hitsPerPage    = $results['hitsPerPage'];
        $processingTime = $results['processingTimeMS'];
        $searchQuery    = $results['query'];
        $params         = $results['params'];

        // Store the results
        parent::__construct($hits);

        $this->totalCount     = $totalCount;
        $this->processingTime = $processingTime;
        $this->searchQuery    = $searchQuery;
        $this->params         = $params;

        // Paginate the collection
        $this->pagination = new Pagination([
            'page'  => $page,
            'total' => $totalCount,
            'limit' => $hitsPerPage,
        ]);

    }

    /**
    * Returns the total count of results for the search query
    * $results->count() returns the count of results on the current pagination page
    *
    * @return int
    */
    public function totalCount()
    {
        return $this->totalCount;
    }

    /**
    * Returns the Algolia server processing time in ms
    *
    * @return int
    */
    public function processingTime()
    {
        return $this->processingTime;
    }

    /**
    * Returns the search query
    *
    * @return string
    */
    public function searchQuery()
    {
        return $this->searchQuery;
    }

    /**
    * Returns the Algolia search parameter string
    * Useful when debugging search requests
    *
    * @return string
    */
    public function params()
    {
        return $this->params;
    }
}
