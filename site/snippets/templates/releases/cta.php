<?php

$buttons = [
	[
		'text' => 'Docs',
		'link' => $page->docs()->or('/docs'),
		'icon' => 'book'
	],
];

if ($page->isLatestMajor()) {
	$buttons[] = [
		'text' => 'Try now',
		'link' => $page->tryLink()->or('/try'),
		'icon' => 'download'
	];
}

if (count($buttons) > 1) {
	$buttons[0]['style'] = 'outlined';
}

snippet('cta', [
	'buttons' => $buttons,
	...$options ?? []
]);
