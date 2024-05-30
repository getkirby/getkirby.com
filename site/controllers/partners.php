<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;

return function (App $kirby, Page $page) {
	$partners = $page->children()->listed()->shuffle();

	$filters = [
		'languages' => [
			'label'    => 'Language filter',
			'default'  => 'All languages',
			'multiple' => true
		],
		'region' => [
			'label'    => 'Region filter',
			'default'  => 'All regions',
			'multiple' => false
		],
		'type' => [
			'label'    => 'Business type filter',
			'default'  => 'All business types',
			'field'    => 'typeLabel',
			'multiple' => false
		],
	];

	// collect all possible options, alphabetically sorted
	foreach ($filters as $field => $config) {
		$options = $partners->pluck(
			$config['field'] ?? $field,
			$config['multiple'] ? ',' : null,
			true
		);

		sort($options, SORT_STRING);

		$filters[$field]['options'] = $options;
	}

	// randomize the page more quickly in the CDN
	$kirby->response()->header('Cache-Control', 'max-age=1800, public');

	return [
		'filters'  => $filters,
		'partners' => $partners,
		'plus'     => $partners->filterBy('isPlusPartner', true),
		'standard' => $partners->filterBy('isPlusPartner', false),
	];
};
