<?php

namespace Kirby\Search;

use Exception;
use Loupe\Loupe\Configuration;
use Loupe\Loupe\Loupe;
use Loupe\Loupe\LoupeFactory;
use Loupe\Loupe\SearchParameters;

/**
 * Main Search class for Loupe integration
 * Provides an interface for indexing and searching documents
 *
 * @package   Kirby Search
 * @author    Ahmet Bora <ahmet@getkirby.com>,
 *            Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
class LoupeSearch extends Search
{
	public Loupe $loupe;

	public function __construct()
	{
		parent::__construct();

		$this->options = $this->kirby->option('search.providers.loupe', []);

		if ($this->options === []) {
			throw new Exception('Please configure the Loupe search plugin in your Kirby configuration.');
		}

		$config = Configuration::create()
			->withPrimaryKey('objectID')
			->withSearchableAttributes($this->options['searchable'] ?? ['*'])
			->withFilterableAttributes($this->options['filterable'] ?? [])
			->withSortableAttributes($this->options['sortable'] ?? []);

		$this->loupe = (new LoupeFactory())->create(
			$this->kirby->root('logs') . '/loupe',
			$config
		);
	}

	/**
	 * Get the index instance
	 */
	public function index(): LoupeIndex
	{
		return $this->index ??= new LoupeIndex($this);
	}

	/**
	 * Perform a search query
	 */
	public function query(
		string|null $query = null,
		array $options = []
	): Results {
		$options = [
			...$this->options['options'] ?? [],
			...$options,
			'limit' => $options['limit'] ?? 20,
			'query' => $query
		];

		if ($query === null || $query === '') {
			return Results::from([], $options['page'], $options['limit']);
		}

		// Create search parameters
		$params = SearchParameters::create()
			->withQuery($query)
			->withHitsPerPage($options['limit'])
			->withPage($options['page']);

		// Add filters if provided
		if (empty($options['filter']) === false) {
			$params = $params->withFilter($options['filter']);
		}

		// Add attributes to retrieve if specified
		if (empty($options['attributes_to_retrieve']) === false) {
			$params = $params->withAttributesToRetrieve($options['attributes_to_retrieve']);
		}

		$results = $this->loupe->search($params);

		return Results::from(
			hits: $results->getHits(),
			page: $results->getPage(),
			total: $results->getTotalHits(),
			limit: $results->getHitsPerPage()
		);
	}
}
