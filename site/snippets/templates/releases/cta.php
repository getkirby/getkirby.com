<?php

$version = $page->versionField();
$docs    = $kirby->option('versions')[$version->value()]['link'] ?? '/docs';

$buttons = [
	[
		'text' => 'Docs',
		'link' => $page->docs()->or($docs),
		'icon' => 'book'
	],
];

if ((int)$kirby->version() === $version->toInt()) {
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
