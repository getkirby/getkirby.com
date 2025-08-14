<?php

use Kirby\Cms\App;

return function (App $kirby) {
	$query = trim(get('q', ''));
	$area  = trim(get('area', ''));
	$areas = $kirby->option('search.areas')($kirby);

	if ($query !== '') {
		$results = search(
			area:  $area,
			query: $query,
			page:  param('page', 1),
			limit: get('limit', 50)
		);
	}

	return [
		'results'    => $results ?? [],
		'pagination' => $results?->pagination() ?? null,
		'query'      => html(strip_tags($query), false),
		'area'       => empty($area) ? null : $area,
		'areas'      => $areas
	];
};
