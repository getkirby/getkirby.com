<?php

return [
	'exclude' => [
		'pages' => function () {
			$pages = [];

			foreach (page('docs/reference/objects')->grandChildren() as $page) {
				if (ReferenceClassesPage::isFeatured($page->id()) === false) {
					$pages[] = $page->id() . '.*';
				}
			}

			return $pages;
		},
		'templates' => [
			'answer',
			'answers',
			'brand',
			'brands',
			'error',
			'event',
			'gallery-item',
			'home-story',
			'legacy',
			'link',
			'partners-lead-success',
			'partners-signup-success',
			'reference-classes',
			'reference-shortlink',
			'search',
			'separator',
			'theme',
			'theme-developer',
			'voice',
			'voices',
			'year',
		]
	],
];
