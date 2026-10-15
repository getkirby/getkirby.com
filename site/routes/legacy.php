<?php

return [
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
