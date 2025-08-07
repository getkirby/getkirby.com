<?php

return function () {
	$sections = [
		'guide',
		'reference',
		'cookbook',
		'quicktips',
		'glossary'
	];

	$docs = page('docs')
		->children()
		->find(...$sections)
		->listed();

	return [
		'docs' => $docs,
	];
};
