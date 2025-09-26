<?php

use Kirby\Cms\App;

return function (App $kirby) {
	$query   = trim(get('q', ''));
	$area    = trim(get('area', ''));
	$results = null;

	if (empty($query) === false) {
		$params = [
			'hitsPerPage'           => (int)get('limit', 50),
			'attributesToHighlight' => false,
			'attributesToSnippet'   => '*'
		];

		if (empty($area) == false && $area !== 'all') {
			$params['filters'] = 'area:' . $area;
		}

		$results = algolia()->query($query, param('page') ?? 1, $params);
	}

	return [
		'results'    => $results ?? [],
		'pagination' => $results?->pagination(),
		'query'      => html(strip_tags($query), false),
		'area'       => empty($area) ? null : $area,
		'areas'      => $kirby->option('search.areas')
	];
};
