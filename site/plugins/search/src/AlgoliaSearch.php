<?php

namespace Kirby\Search;

use Algolia\AlgoliaSearch\Api\SearchClient as Algolia;
use Exception;

/**
 * Algolia Search
 *
 * @package   Kirby Search
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
class AlgoliaSearch extends Search
{
	public Algolia $algolia;

	public function __construct()
	{
		parent::__construct();

		$this->options = $this->kirby->option('search.providers.algolia', []);

		if (isset($this->options['app']) === false) {
			throw new Exception('Please set your Algolia API credentials in the Kirby configuration.');
		}

		// use the search-only API key as fallback
		$this->options['key'] = $this->kirby->option('keys.algolia', 'd161a2f4cd2d69247c529a3371ad3050');

		$this->algolia = Algolia::create(
			$this->options['app'],
			$this->options['key']
		);
	}

	public function index(): AlgoliaIndex
	{
		return $this->index ??= new AlgoliaIndex($this);
	}

	/**
	 * Sends a search query to Algolia and returns
	 * a paginated collection of results
	 *
	 * @param string|null $query Search query
	 * @param array $options Search parameters to override the default settings
	 *                       See https://www.algolia.com/doc/api-client/methods/search/
	 */
	public function query(
		string|null $query = null,
		array $options = []
	): Results {
		$options = [
			...$this->options['options'] ?? [],
			...$options,
			'query' => $query
		];

		// Set the page parameter
		// Algolia uses zero based page indexes while
		// Kirby's pagination starts at 1
		$options['page'] = $options['page'] ? $options['page'] - 1 : 0;

		// Get results response
		$response = $this->algolia->searchSingleIndex(
			$this->options['index'],
			$options
		);

		// Return collection of the results
		return Results::from(
			hits: $response['hits'],
			page: ($response['page'] ?? 0) + 1,
			total: $response['nbHits'] ?? 0,
			limit: $response['hitsPerPage'] ?? 20
		);
	}
}
