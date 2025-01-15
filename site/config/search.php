<?php

use Kirby\Toolkit\Str;

return [
	'algolia' => [
		'app'       => 'S7OGBIAJTV',
		'index'     => 'getkirby-4',
		'fields'    => [
			'title',
			'keywords',
			'byline'   =>
				fn ($page) => strip_tags($page->searchbyline()->kti()),
			'intro'    => function ($page) {
				$html = $page->description()->or($page->intro())->kti();
				return strip_tags($html);
			},
			'text'     => function ($page) {
				return strip_tags($page->text()->kti());
			},
			'area'     => function ($page) {
				if (Str::startsWith($page->id(), 'docs/reference') === true) {
					return 'reference';
				}

				return match ($page->intendedTemplate()->name()) {
					'cookbook-recipe' => 'cookbook',
					'guide'           => 'guide',
					'kosmos-issue'    => 'kosmos',
					'plugin'          => 'plugin',
					default           => null
				};
			},
			'weight'   => function ($page) {
				return match ($page->intendedTemplate()->name()) {
					'guide',
					'cookbook-recipe'     => 2,
					'reference-classmethod',
					'reference-component',
					'reference-endpoint',
					'reference-fieldmethod',
					'reference-helper',
					'reference-hook',
					'reference-kirbytag',
					'reference-validator' => 0.5,
					'referece-icon',
					'reference-root',
					'reference-url'       => 0.25,
					default               => 1
				};
			}
		],
		'templates' => [
			'cookbook-category',
			'cookbook-recipe',
			'glossary',
			'guide',
			'kosmos-issue',
			'plugin',
			'reference-article',
			'reference-block',
			'reference-class',
			'reference-classmethod',
			'reference-component',
			'reference-endpoint',
			'reference-extension',
			'reference-fieldmethod',
			'reference-helper',
			'reference-hook',
			'reference-icon',
			'reference-kirbytag',
			'reference-panelsection',
			'reference-root',
			'reference-section',
			'reference-ui',
			'reference-url',
			'reference-validator',
			'reference-validators',
			'security',
			'text',
			'release',
			'release-35'
		]
	],
	'areas'   => [
		'all'       => 'All pages',
		'guide'     => 'Guide',
		'reference' => 'Reference',
		'cookbook'  => 'Cookbook',
		'plugin'    => 'Plugin',
		'kosmos'    => 'Kosmos'
	],
];
