<?php

use Kirby\Cms\App;
use Kirby\Search\AlgoliaSearch;
use Kirby\Search\LoupeSearch;
use Kirby\Search\Results;
use Kirby\Search\Search;

include __DIR__ . '/vendor/autoload.php';

function search(
	string $area,
	string $query,
	int $page = 1,
	int $limit = 50
): Results {
	$search  = Search::instance();
	$options = [
		'page' => $page
	];

	if ($search instanceof LoupeSearch) {
		$options['limit'] = $limit;

		if ($area !== '' && $area !== 'all') {
			$options['filter'] = "area = '$area'";
		}
	} else{
		$options['hitsPerPage']           = $limit;
		$options['attributesToHighlight'] = false;
		$options['attributesToSnippet']   = '*';

		if ($area !== '' && $area !== 'all') {
			$options['filters'] = 'area:' . $area;
		}
	}

	return (new $search())->query($query, $options);
}
