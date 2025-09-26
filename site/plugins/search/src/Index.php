<?php

namespace Kirby\Search;

use Kirby\Cms\App;
use Kirby\Cms\Page;
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

	public function __construct(protected Search $search)
	{
	}

	/**
	 * Retrieve all indexable pages as entries
	 */
	protected function entries(): Pages
	{
		return $this->entries ??= App::instance()
			->site()
			->index()
			// inject the plugins from the collection that fetches from plugins.getkirby.com
			->merge(App::instance()->collection('plugins'))
			->map(fn (Page $page) => new Entry($page, $this->search))
			->filter(fn (Entry $entry) => $entry->isIndexable());
	}

	/**
	 * Indexes everything and replaces the current index
	 *
	 * Uses atomical re-indexing: https://www.algolia.com/doc/api-reference/api-methods/replace-all-objects/
	 */
	public function generate(): void
	{
		$entries = $this->entries()->map(fn ($entry) => $entry->toData());
		$this->search->algolia->replaceAllObjects($this->search->options['index'], $entries);
	}

	/**
	 * Returns the number of indexable pages/entries
	 */
	public function count(): int
	{
		return $this->entries()->count();
	}
}
