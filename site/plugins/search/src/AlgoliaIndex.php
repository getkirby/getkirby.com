<?php

namespace Kirby\Search;

use Kirby\Cms\App;
use Kirby\Cms\Pages;

/**
 * Algolia Search Index
 *
 * @package   Kirby Search
 * @author    Lukas Bestle <lukas@getkirby.com>,
 *            Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
class AlgoliaIndex extends Index
{
	/**
	 * @var \Kirby\Search\AlgoliaSearch
	 */
	protected Search $search;

	/**
	 * Indexes everything and replaces the current index
	 *
	 * Uses atomical re-indexing: https://www.algolia.com/doc/api-reference/api-methods/replace-all-objects/
	 */
	public function generate(): void
	{
		$entries = [];

		foreach ($this->entries() as $entry) {
			$entries[] = $entry->toData();
		}

		$this->search->algolia->replaceAllObjects(
			$this->search->options['index'],
			$entries
		);
	}

	/**
	 * Inject the plugins from the collection
	 * that fetches from plugins.getkirby.com
	 */
	protected function index(): Pages
	{
		return $this->index ??= parent::index()->merge(
			App::instance()->collection('plugins')
		);
	}
}
