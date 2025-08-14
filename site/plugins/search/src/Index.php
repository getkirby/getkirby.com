<?php

namespace Kirby\Search;

use Generator;
use Kirby\Cms\App;
use Kirby\Cms\Pages;

/**
 * Search Index
 *
 * @package   Kirby Search
 * @author    Lukas Bestle <lukas@getkirby.com>,
 *            Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
abstract class Index
{
	protected Pages $index;

	public function __construct(protected Search $search)
	{
	}

	/**
	 * Retrieve all indexable pages as entries
	 * @return \Generator|\Kirby\Search\Entry[]
	 */
	protected function entries(): Generator
	{
		foreach ($this->index() as $page) {
			$entry = new Entry($page, $this->search);

			if ($entry->isIndexable() === true) {
				yield $entry;
			}
		}
	}

	/**
	 * Indexes everything and replaces the current index
	 */
	abstract public function generate(): void;

	protected function index(): Pages
	{
		return $this->index ??= App::instance()->site()->index();
	}
}
