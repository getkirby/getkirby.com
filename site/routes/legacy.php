<?php

return [
	// August 2024
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

	// October 2026: picker fields renamed in Kirby 6
	[
		'pattern' => 'docs/reference/panel/fields/(files|pages|users)',
		'action'  => fn (string $type) => go('docs/reference/panel/fields/' . rtrim($type, 's') . 'picker')
	],
];
