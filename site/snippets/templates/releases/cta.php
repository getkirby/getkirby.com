<?php snippet('cta', array_merge([
	'buttons' => [
		[
			'text' => 'Try now',
			'link' => $page->link(),
			'icon' => 'download'
		],
		[
			'text' => 'Docs',
			'link' => '/docs',
			'icon' => 'book',
			'style' => 'outlined'
		]
	]
], $options ?? [])) ?>