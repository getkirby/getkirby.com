<?php
/**
 * @var string|null $area
 * @var Kirby\Cms\Pagination|null $pagination
 * @var string $query
 * @var Kirby\Search\Results|array $results
 */

echo json([
	'query'      => $query,
	'area'       => $area,
	'results'    => $results ?? [],
	'pagination' => $pagination?->toArray(),
]);
