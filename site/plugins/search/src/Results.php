<?php

namespace Kirby\Search;

use Kirby\Cms\Pagination;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;

/**
 * Kirby Search Results
 *
 * @author Nico Hoffmann <nico@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Results extends Collection
{
	public static function from(array $response): static
	{
		// Convert the hits to Obj objects
		$hits    = A::map($response['hits'], fn ($hit) => new Obj($hit));
		$results = new static($hits);

		$results->pagination = new Pagination([
			'page'  => ($response['page'] ?? 0) + 1,
			'total' => $response['nbHits'] ?? 0,
			'limit' => $response['hitsPerPage'] ?? 20,
		]);

		return $results;
	}
}
