<?php snippet('cta', array_merge([
	'buttons' => [
		[
			'text' => 'Docs',
			'link' => $page->docs()->or('/docs'),
			'icon' => 'book',
			'style' => 'outlined'
		],
		[
			'text' => 'Try now',
			'link' => $page->link(),
			'icon' => 'download'
		],
	]
], $options ?? [])) ?>
