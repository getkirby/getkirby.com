<?php

namespace Kirby\Search;

use Kirby\Cms\App;

/**
 * The Search class is the main interface to generate the
 * search index or run any search queries
 *
 * @package   Kirby Search
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
abstract class Search
{
	public Index $index;
	public App $kirby;
	public array $options = [];

	public function __construct()
	{
		$this->kirby = App::instance();
	}

	abstract public function index(): Index;

	public static function instance(): static
	{
		$class = match (App::instance()->option('archived', false)) {
			true  => LoupeSearch::class,
			false => AlgoliaSearch::class
		};

		return new $class();
	}

	/**
	 * Returns a paginated collection of results
	 */
	abstract public function query(
		string|null $query = null,
		array $options = []
	): Results;
}
