<?php

namespace Kirby\Search;

use Kirby\Cms\Pagination;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;

/**
 * Search results
 *
 * @package   Kirby Search
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
class Results extends Collection
{
	public static function from(
		array $hits,
		int $page = 1,
		int $limit = 20,
		int $total = 0
	): static {
		// Convert the hits to Obj objects
		$hits    = A::map($hits, fn ($hit) => new Obj($hit));
		$results = new static($hits);

		$results->pagination = new Pagination([
			'page'  => $page,
			'total' => $total,
			'limit' => $limit,
		]);

		return $results;
	}
}
