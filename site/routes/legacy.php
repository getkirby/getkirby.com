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
		'pattern' => 'docs/cookbook/extensions/virtual-files',
		'action'  => fn () => go('docs/guide/virtual-content/virtual-files')
	],
	[
		'pattern' => 'docs/cookbook/content-representations/load-more-with-ajax',
		'action'  => fn () => go('docs/cookbook/content-representations/ajax-load-more')
	],
	[
		'pattern' => 'docs/cookbook/setup/ddev',
		'action'  => fn () => go('docs/cookbook/development-deployment/ddev')
	],
	[
		'pattern' => [
			'docs/cheatsheet/(:any)/(:any)',
			'docs/reference/(:any)/(:any)',
			'docs/reference/objects/(:any)/(:any)',
			'docs/reference/tools/(:any)/(:any)'
		],
		'action'  => function (string $object, string $method) {
			if ($page = page('docs/reference/objects/cms/' . $object . '/' . $method)) {
				go($page);
			}

			if ($page = page('docs/reference/objects/toolkit/' . $object . '/' . $method)) {
				go($page);
			}

			if ($page = page('docs/reference/objects/http/' . $object . '/' . $method)) {
				go($page);
			}

			$this->next();
		}
	],
	[
		'pattern' => 'made-with-kirby-and-love',
		'action'  => fn () => go('/')
	],
];
