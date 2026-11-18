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

	// August 2026: internal `Field` methods are only documented
	// on the `Field` class, no longer as field methods
	[
		'pattern' => 'docs/reference/templates/field-methods/(exists|model|parent|to-array|to-string)',
		'action'  => fn (string $method) => go('docs/reference/objects/content/field/' . $method)
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

	// Kirby 6: picker fields were renamed, sections became fields
	[
		'pattern' => 'docs/reference/panel/(fields|sections)/(files|pages|users)',
		'action'  => function (string $group, string $type) {
			$suffix = $group === 'fields' ? 'picker' : 'list';
			go('docs/reference/panel/fields/' . rtrim($type, 's') . $suffix);
		}
	],
	[
		'pattern' => 'docs/cookbook/(:any)/first-panel-section',
		'action'  => fn () => go('docs/cookbook/panel/first-panel-field#fields-without-a-value')
	],
	[
		'pattern' => 'docs/reference/panel/sections',
		'action'  => fn () => go('docs/guide/updates/update-to-v6#sections-are-now-fields')
	],
	[
		'pattern' => 'docs/reference/panel/sections/fields',
		'action'  => fn () => go('docs/guide/updates/update-to-v6#sections-are-now-fields__what-each-section-became')
	],
	[
		'pattern' => 'docs/reference/panel/sections/(info|stats)',
		'action'  => fn (string $type) => go('docs/reference/panel/fields/' . $type)
	],
	[
		'pattern' => 'docs/reference/plugins/extensions/sections',
		'action'  => fn () => go('docs/guide/updates/update-to-v6#custom-sections-in-plugins')
	],
	[
		'pattern' => 'docs/reference/api/(pages|site|users)/files-section',
		'action'  => fn (string $model) => go('docs/reference/api/' . $model . '/files-field')
	],
	[
		'pattern' => 'docs/reference/api/(site|users)/section',
		'action'  => fn (string $model) => go('docs/reference/api/' . $model . '/field')
	],

	// Kirby 6: renamed classes and field methods
	[
		'pattern' => 'docs/reference/objects/session/session-data',
		'action'  => fn () => go('docs/reference/objects/session/data')
	],
	[
		'pattern' => 'docs/reference/templates/field-methods/kirbytextinline',
		'action'  => fn () => go('docs/reference/templates/field-methods/kirbytext-inline')
	],

	// October 2026: reference shortlinks use their full menu path as slug
	// (e.g. `objects/objects-cms-page`), redirect the old short slugs
	// (e.g. `objects/page`, `objects/session-data`)
	[
		'pattern' => 'docs/reference/(objects|tools)/(:any)',
		'action'  => function (string $section, string $slug) {
			$parent = page('docs/reference/' . $section);

			if ($parent !== null && $parent->find($slug) === null) {
				foreach ($parent->menu()->yaml() as $path) {
					$old = [
						basename($path),
						basename(dirname($path)) . '-' . basename($path)
					];

					if (in_array($slug, $old, true) === true) {
						go('docs/reference/' . $path);
					}
				}
			}

			$this->next();
		}
	],
];
