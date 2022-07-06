<?php

return function ($kirby) {

	$query = trim(get('q'));
	$area  = trim(get('area'));

	if (empty($query) === false) {

		$params = [
			'hitsPerPage'		   => 50,
			'attributesToHighlight' => false,
			'attributesToSnippet'   => '*'
		];

		if (empty($area) == false && $area !== 'all') {
			$params['filters'] = 'area:' . $area;
		}

		$results = algolia()->search($query, param('page') ?? 1, $params);
	}

	return [
		'results'	=> $results ?? [],
		'pagination' => isset($results) ? $results->pagination() : null,
		'query'	  => html(strip_tags($query), false),
		'area'	   => empty($area) ? null : $area,
		'areas'	  => option('search.areas')
	];
};
