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
			'error',
			'link',
			'reference-classes',
			'reference-shortlink',
			'separator'
		]
	],
];