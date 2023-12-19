<?php

namespace Kirby\Search;

use Kirby\Cms\App;
use Kirby\Cms\Pages;

/**
 * Kirby Search Index
 *
 * @author Lukas Bestle <lukas@getkirby.com>
 * @author Nico Hoffmann <nico@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Index
{
	protected Pages $entries;
	public $index;

	public function __construct(protected Search $search)
	{
		$this->index = $search->algolia->initIndex($search->options['index']);
	}

	/**
	 * Retrieve all indexable pages as entries
	 */
	protected function entries(): Pages
	{
		return $this->entries ??= App::instance()->site()->index()->map(
			fn ($page) => new Entry($page, $this->search)
		)->filter(
			fn ($entry) => $entry->isIndexable()
		);
	}

	/**
	 * Indexes everything and replaces the current index
	 *
	 * Uses atomical re-indexing: https://www.algolia.com/doc/api-reference/api-methods/replace-all-objects/
	 */
	public function generate(): void
	{
		$objects = $this->entries()->map(fn ($entry) => $entry->toData());
		$this->index->replaceAllObjects($objects);
	}

	/**
	 * Returns the number of indexable pages/entries
	 */
	public function count(): int
	{
		return $this->entries()->count();
	}
}
