<?php

use Kirby\Cms\App;

return function (App $kirby) {
	$query = trim(get('q', ''));
	$area = trim(get('area', ''));
	$results = null;

	if ($query !== '') {
		// search using Loupe if documents are archived, otherwise use Algolia
		if (option('archived', false) === true) {
			$params = [
				'limit' => (int)get('limit', 50)
			];

			if ($area !== '' && $area !== 'all') {
				$params['filter'] = "area = '$area'";
			}

			$results = loupe()->query($query, param('page') ?? 1, $params);
		} else {
			$params = [
				'hitsPerPage'           => (int)get('limit', 50),
				'attributesToHighlight' => false,
				'attributesToSnippet'   => '*'
			];

			if ($area !== '' && $area !== 'all') {
				$params['filters'] = 'area:' . $area;
			}

			$results = algolia()->query($query, param('page') ?? 1, $params);
		}
	}

	return [
		'results'    => $results ?? [],
		'pagination' => $results?->pagination(),
		'query'      => html(strip_tags($query), false),
		'area'       => empty($area) ? null : $area,
		'areas'      => $kirby->option('search.areas')
	];
};
