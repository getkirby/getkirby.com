<?php

use Kirby\Cms\Pages;
use Kirby\Data\Data;
use Kirby\Filesystem\Dir;
use Kirby\Reference\SectionPage;
use Kirby\Toolkit\Str;

class ReferenceClassesPage extends SectionPage
{
	/**
	 * Creates children collection by parsing the `src/` folder of
	 * the Kirby core
	 */
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children = [];

		// Add unlisted pages for all classes in namespace:
		// Loop through filesystem as proxy for namespace structure
		$root = $this->kirby()->root('kirby') . '/src';

		foreach (Dir::dirs($root) as $package) {
			// Add page and subpages for each namespace package
			$children[] = $this->childrenForNamespace(
				$name = ucfirst($package),
				$root . '/' . $package,
			);

			// Add class page and method subpages for all nested namespaces
			// (only supports one level below main, e.g. `Kirb\Cms\Foo\Bar`)
			foreach (Dir::dirs($root . '/' . $package) as $subpackage) {
				$children[] = $this->childrenForNamespace(
					$name . '\\' . ucfirst($subpackage),
					$root . '/' . $package . '/' . $subpackage
				);
			}
		}

		// Add listed shortlink for all pages defined in the
		// content file in the `menu` field
		array_push(
			$children,
			...ReferenceQuickLinkPage::childrenFromContentField($this->menu())
		);

		// Add shortlink to overview and
		// class alias page as listed children
		$children[] = [
			'slug'     => Str::random(3),
			'template' => 'separator',
			'num'      => 0
		];
		$children[] = [
			'slug'     => 'all',
			'model'    => 'link',
			'template' => 'link',
			'num'      => 1,
			'content'  => [
				'title' => 'All classes',
				'link'  => url('docs/reference/objects')
			]
		];

		$children[] = [
			'slug'     => 'aliases',
			'model'    => 'reference-classaliases',
			'template' => 'reference-classaliases',
			'num'      => 2,
			'content'  => [
				'title' => 'Aliases',
				'intro' => 'In Kirby, classes are separated in different namespaces such as `Kirby\Cms\` or `Kirby\Http\`. Aliases help to access specific classes without the need to mention their namespace.'
			]
		];

		return $this->children = Pages::factory($children, $this);
	}

	/**
	 * Returns page props for namespace
	 * with classes as children and methods as grandchildren
	 */
	protected function childrenForNamespace(
		string $name,
		string $root
	): array {
		return [
			'slug'     => $slug = Str::slug($name),
			'template' => 'link',
			'parent'   => $this,
			'num'      => null,
			'content'  => [
				'title' => 'Kirby\\' . $name,
				'link'  => 'docs/reference/objects#' . $slug
			],
			'children' => $this->childrenForClasses($name, $root)
		];
	}

	/**
	 * Creates an array of page props for all class files in the
	 * provided root, assigning them to a provided namespace
	 */
	protected function childrenForClasses(
		string $namespace,
		string $root
	): array {
		$children = [];

		// Loop through each class PHP file and
		// create as child page
		foreach (Dir::files($root) as $class) {
			$name  = ucfirst(basename($class, '.php'));
			$class = 'Kirby\\' . $namespace . '\\' . $name;
			$slug  = Str::kebab($name);
			$root  = $this->root() . '/' . Str::kebab($namespace) . '/0_' . $slug;

			try {
				$content = Data::read($root . '/reference-class.txt');
			} catch (Throwable) {
				$content = [];
			}

			$children[] = [
				'slug'     => $slug,
				'root'     => $root,
				'model'    => 'reference-class',
				'content'  => [
					...$content,
					'class' => $class
				]
			];
		}

		// we need to create a Pages collection to properly filter
		// pages (e.g. as non-internal); however, we need to pass the
		// data on as array again to be consumable by the upper
		// Pages::factory() call
		return Pages::factory($children)
			->filterBy('isInternal', false)
			->toArray(fn ($page) => [
				'slug'     => $page->slug(),
				'root'     => $page->root(),
				'model'    => 'reference-class',
				'template' => 'reference-class',
				'num'      => 0,
				'content'  => $page->content()->toArray()
			]);
	}

	public static function isFeatured(string $page): bool
	{
		$ids = [
			...page('docs/reference/objects')->menu()->yaml(),
			...page('docs/reference/tools')->menu()->yaml()
		];

		foreach ($ids as $id) {
			if (Str::endsWith($page, $id)) {
				return true;
			}
		}

		return false;
	}
}
