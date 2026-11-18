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
		'pattern' => [
			'docs/reference/panel/sections',
			'docs/reference/panel/sections/fields'
		],
		'action'  => fn () => go('docs/guide/updates/update-to-v6/site-developers#blueprints__sections-become-fields')
	],
	[
		'pattern' => 'docs/reference/panel/sections/(info|stats)',
		'action'  => fn (string $type) => go('docs/reference/panel/fields/' . $type)
	],
	[
		'pattern' => 'docs/reference/plugins/extensions/sections',
		'action'  => fn () => go('docs/guide/updates/update-to-v6/plugin-developers/sections')
	],
	[
		'pattern' => [
			'docs/guide/blueprints/presets',
			'docs/reference/panel/presets',
			'docs/reference/panel/presets/(files|page|pages)'
		],
		'action'  => fn () => go('docs/guide/updates/update-to-v6/site-developers#blueprints__blueprint-presets')
	],
	[
		'pattern' => 'docs/reference/api/(pages|site|users)/files-section',
		'action'  => fn (string $model) => go('docs/reference/api/' . $model . '/files-field')
	],
	[
		'pattern' => 'docs/reference/api/(site|users)/section',
		'action'  => fn (string $model) => go('docs/reference/api/' . $model . '/field')
	],

	// Kirby 6: the migration guides moved from the release page
	// into the update guide
	[
		'pattern' => 'releases/6/migration/(:all?)',
		'action'  => fn (string $path = '') => go(rtrim('docs/guide/updates/update-to-v6/' . $path, '/'))
	],

	// Kirby 6: renamed field methods, removed or moved classes and methods
	[
		'pattern' => 'docs/reference/templates/field-methods/kirbytextinline',
		'action'  => fn () => go('docs/reference/templates/field-methods/kirbytext-inline')
	],
	[
		'pattern' => 'docs/reference/objects/(:any)/(:any)/(:any?)',
		'action'  => function (string $namespace, string $class, string $method = '') {
			// leave content representations like `.md` alone
			if (str_contains($class . $method, '.') === true) {
				return $this->next();
			}

			// the class still exists, but the method was removed
			if ($page = page('docs/reference/objects/' . $namespace . '/' . $class)) {
				if ($method !== '' && $page->find($method) === null) {
					go($page);
				}

				return $this->next();
			}

			$key = $namespace . '/' . $class;

			// removed classes without a successor
			$removed = [
				'cms/section'       => 'docs/guide/updates/update-to-v6/plugin-developers/sections',
				'toolkit/component' => 'docs/guide/updates/update-to-v6/site-developers#custom-code-using-core-classes__moved-and-deprecated-classes',
			];

			if (isset($removed[$key]) === true) {
				go($removed[$key]);
			}

			// removed classes with a successor (see the Kirby 6 changelog);
			// moved classes are found through their deprecated alias
			$replaced = [
				'cms-auth/challenge'             => 'Kirby\Auth\Challenge',
				'cms-auth/email-challenge'       => 'Kirby\Auth\Challenge\EmailChallenge',
				'cms-auth/totp-challenge'        => 'Kirby\Auth\Challenge\TotpChallenge',
				'cms/file-picker'                => 'Kirby\Panel\Controller\Dialog\FilePickerDialogController',
				'cms/page-picker'                => 'Kirby\Panel\Controller\Dialog\PagePickerDialogController',
				'cms/picker'                     => 'Kirby\Panel\Controller\Dialog\ModelPickerDialogController',
				'cms/user-picker'                => 'Kirby\Panel\Controller\Dialog\UserPickerDialogController',
				'form-mixin/value'               => 'Kirby\Form\Field\ValueField',
				'form/field-class'               => 'Kirby\Form\Field',
				'panel-controller/page-tree'     => 'Kirby\Panel\Controller\Request\PageTreeRequestController',
				'panel-controller/search'        => 'Kirby\Panel\Controller\SearchController',
				'panel-ui-buttons/languages-dropdown' => 'Kirby\Panel\Ui\Button\LanguagesButton',
				'panel/changes-dialog'           => 'Kirby\Panel\Controller\Dialog\ChangesDialogController',
				'panel/dialog'                   => 'Kirby\Panel\Response\DialogResponse',
				'panel/document'                 => 'Kirby\Panel\Response\ViewDocumentResponse',
				'panel/drawer'                   => 'Kirby\Panel\Response\DrawerResponse',
				'panel/dropdown'                 => 'Kirby\Panel\Response\DropdownResponse',
				'panel/json'                     => 'Kirby\Panel\Response\JsonResponse',
				'panel/page-create-dialog'       => 'Kirby\Panel\Controller\Dialog\PageCreateDialogController',
				'panel/request'                  => 'Kirby\Panel\Response\RequestResponse',
				'panel/search'                   => 'Kirby\Panel\Response\SearchResponse',
				'panel/user-totp-disable-dialog' => 'Kirby\Panel\Controller\Drawer\UserTotpDrawerController',
				'panel/user-totp-enable-dialog'  => 'Kirby\Panel\Controller\Drawer\UserTotpDrawerController',
				'panel/view'                     => 'Kirby\Panel\Response\ViewResponse',
				'query/argument'                 => 'Kirby\Query\Query',
				'query/arguments'                => 'Kirby\Query\Query',
				'query/expression'               => 'Kirby\Query\Query',
				'query/segment'                  => 'Kirby\Query\Query',
				'query/segments'                 => 'Kirby\Query\Query',
				'session/auto-session'           => 'Kirby\Session\Sessions',
			];

			$name = $replaced[$key] ?? 'Kirby\\' . implode('\\', array_map('ucfirst', explode('-', $namespace))) . '\\' . Kirby\Toolkit\Str::studly($class);

			if (
				class_exists($name) === true ||
				interface_exists($name) === true ||
				trait_exists($name) === true
			) {
				$name = (new ReflectionClass($name))->getName();

				if ($page = ReferenceClassPage::findByName($name)) {
					go(($method !== '' ? $page->find($method) : null) ?? $page);
				}
			}

			return $this->next();
		}
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
