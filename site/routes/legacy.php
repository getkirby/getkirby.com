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

	// August 2024
	[
		'pattern' => 'docs/cookbook/setup/ddev',
		'action'  => fn () => go('docs/cookbook/development-deployment/ddev')
	],
	[
		'pattern' => [
			'docs/cheatsheet/(:any)/(:any)',
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

	// June 2025
	[
		'pattern' => 'buzz/v5-alpha',
		'action'  => fn () => go('releases/5')
	],

	// September 2026: restructured plugin chapter
	[
		'pattern' => 'docs/guide/plugins/installing-plugins',
		'action'  => fn () => go('docs/guide/plugins/basics#installing-plugins')
	],
	[
		'pattern' => [
			'docs/guide/plugins/plugin-basics',
			'docs/guide/plugins/custom-plugins'
		],
		'action'  => fn () => go('docs/guide/plugins/basics')
	],
	[
		'pattern' => 'docs/guide/plugins/plugin-setup-basic',
		'action'  => fn () => go('docs/guide/plugins/first-plugin')
	],
	[
		'pattern' => 'docs/guide/plugins/plugin-setup-autoloader',
		'action'  => fn () => go('docs/guide/plugins/structure')
	],
	[
		'pattern' => 'docs/guide/plugins/plugin-setup-composer',
		'action'  => fn () => go('docs/guide/plugins/packaging')
	],
	[
		'pattern' => 'docs/guide/plugins/plugin-setup-panel',
		'action'  => fn () => go('docs/guide/plugins/panel')
	],
	[
		'pattern' => 'docs/guide/plugins/best-practices',
		'action'  => fn () => go('docs/guide/plugins/publishing')
	],
];
