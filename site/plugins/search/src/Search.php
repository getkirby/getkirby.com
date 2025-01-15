<?php

namespace Kirby\Search;

use Algolia\AlgoliaSearch\Api\SearchClient as Algolia;
use Exception;
use Kirby\Cms\App;

/**
 * The Search class is the main interface to generate the
 * search index or run any search queries
 *
 * @author Nico Hoffmann <nico@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Search
{
	public Algolia       $algolia;
	public static Search $instance;
	public Index         $index;
	public array         $options = [];

	public function __construct()
	{
		$this->options = App::instance()->option('search.algolia', []);

		if (isset($this->options['app']) === false) {
			throw new Exception('Please set your Algolia API credentials in the Kirby configuration.');
		}

		// use the search-only API key as fallback
		$this->options['key'] = App::instance()->option('keys.algolia', 'd161a2f4cd2d69247c529a3371ad3050');

		$this->algolia = Algolia::create(
			$this->options['app'],
			$this->options['key']
		);
	}

	public function index(): Index
	{
		return $this->index ??= new Index($this);
	}

	/**
	 * Returns a singleton instance of the Search class
	 */
	public static function instance(): static
	{
		return static::$instance ??= new static();
	}

	/**
	 * Sends a search query to Algolia and returns
	 * a paginated collection of results
	 *
	 * @param string|null $query Search query
	 * @param int $page Pagination page to return (starts at 1, not 0!)
	 * @param array $options Search parameters to override the default settings
	 *                       See https://www.algolia.com/doc/api-client/methods/search/
	 */
	public function query(
		string $query = null,
		int    $page = 1,
		array  $options = []
	): Results {
		$options = [
			...$this->options['options'] ?? [],
			...$options,
			'query' => $query
		];

		// Set the page parameter
		// Algolia uses zero based page indexes while
		// Kirby's pagination starts at 1
		$options['page'] = $page ? $page - 1 : 0;

		// Get results response
		$response = $this->algolia->searchSingleIndex(
			$this->options['index'],
			$options
		);

		// Return collection of the results
		return Results::from($response);
	}
}
