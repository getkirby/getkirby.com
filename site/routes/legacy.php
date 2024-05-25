<?php

return [
	// May 2024
	[
		'pattern' => 'docs/cookbook/setup/git',
		'action'  => fn () => go('docs/guide/install-guide/git')
	],
	[
		'pattern' => 'docs/guide/virtual-pages/simple-virtual-page',
		'action'  => fn () => go('docs/guide/virtual-content/simple-virtual-page')
	],
	[
		'pattern' => 'docs/guide/virtual-pages/content-from-rss-feed',
		'action'  => fn () => go('docs/guide/virtual-content/content-from-rss-feed')
	],
	[
		'pattern' => 'docs/cookbook/content-representations/ajax-load-more',
		'action'  => fn () => go('docs/cookbook/content-representations/load-more-with-ajax')
	]
];
