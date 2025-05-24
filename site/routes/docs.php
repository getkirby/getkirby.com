<?php

use Kirby\Cms\Page;

return [
	[
		'pattern' => 'docs/(:all).md',
		'action'  => function ($path) {
			$page = page('docs/' . $path);

			if (!$page) {
				return page('error');
			}

			$page->kirby()->response()->type('text/plain');

			return new Page([
				'slug'     => $page->slug(),
				'parent'   => $page->parent(),
				'template' => 'llms.md',
				'content'  => [
					'title'       => $page->title()->value(),
					'intro'       => $page->intro()->value(),
					'description' => $page->description()->value(),
					'text'        => $page->text()->value(),
				]
			]);
		}
	],
	[
		'pattern' => 'docs/guide/(:any)/(:any)',
		'action'  => function ($parent, $slug) {
			if ($page = page('docs/guide/' . $parent . '/' . $slug)) {
				return $page;
			}

			if ($page = page('docs/guide/' . $parent)) {
				return $page;
			}

			if ($page = page('docs/guide')->grandChildren()->find($slug)) {
				return $page;
			}

			$this->next();
		}
	],
	[
		'pattern' => 'docs/cookbook/setup/(git|composer)',
		'action'  => function ($slug) {
			$page = page('docs/guide/install-guide/' . $slug);

			if (!$page) {
				$page = page('error');
			}

			return go($page);
		}
	],
	[
		'pattern' => 'docs/cookbook/(:any)/(:any)',
		'action'  => function ($category, $slug) {
			if ($category === 'tags') {
				$this->next();
			}

			// prevent duplicate content with invalid content representations
			if (str_contains($slug, '.') === true) {
				$this->next();
			}

			$page = page('docs/cookbook/' . $category . '/' . $slug);

			if ($page) {
				return $page;
			}

			$page = page('docs/cookbook')->grandChildren()->findBy('slug', $slug);

			if (!$page) {
				$page = page('docs/quicktips/' . $slug);
			}

			if (!$page) {
				$page = page('docs/cookbook')
					->grandChildren()
					->listed()
					->findBy('uid', $category . '/' . $slug);
			}

			if (!$page) {
				$page = page('error');
			}

			return go($page);
		}
	],
	[
		'pattern' => 'docs/cookbook/tags/(:any)',
		'action'  => fn ($tag) => page('docs/cookbook')->render(['tag' => $tag])
	],
	[
		'pattern' => 'docs/quicktips/tags/(:any)',
		'action'  => fn ($tag) => page('docs/quicktips')->render(['tag' => $tag])
	],
];
