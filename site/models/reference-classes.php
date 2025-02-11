<?php

use Kirby\Cms\Pages;
use Kirby\Data\Data;
use Kirby\Filesystem\Dir;
use Kirby\Reference\SectionPage;
use Kirby\Toolkit\A;
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

		foreach (Dir::dirs($root) as $namespace) {
			$children = [
				...$children,
				...$this->childrenFromSrcFolder(
					namespace: $namespace,
					root:      $root . '/' . $namespace
				)
			];
		}

		// Add listed shortlink for each page defined in the
		// `menu `content field as well as a separator, a
		// shortlink to the overview and to the class alias page
		$children = [
			...$children,
			...ReferenceQuickLinkPage::childrenFromContentField($this->menu()),
			[
				'slug'     => '_' . Str::random(10),
				'template' => 'separator',
				'num'      => 0
			],
			[
				'slug'     => 'all',
				'model'    => 'link',
				'template' => 'link',
				'num'      => 1,
				'content'  => [
					'title' => 'All classes',
					'link'  => url('docs/reference/objects')
				]
			],
			[
				'slug'     => 'aliases',
				'model'    => 'reference-classaliases',
				'template' => 'reference-classaliases',
				'num'      => 2,
				'content'  => [
					'title' => 'Aliases',
					'intro' => 'In Kirby, classes are separated in different namespaces such as `Kirby\Cms\` or `Kirby\Http\`. Aliases help to access specific classes without the need to mention their namespace.'
				]
			]
		];

		return $this->children = Pages::factory($children, $this);
	}

	protected function childrenFromSrcFolder(
		string $namespace,
		string $root
	): array {
		$src      = $this->kirby()->root('kirby') . '/src';
		$children = [];

		// Gather all classes in the current namespace as children
		foreach (Dir::files($root) as $class) {
			$class  = ucfirst(basename($class, '.php'));
			$slug   = Str::kebab($class);
			$class  = 'Kirby\\' . $namespace . '\\' . $class;
			$dir    = $this->root();
			$dir   .= Str::lower(Str::after($root, $src));
			$dir   .= '/0_' . $slug;

			try {
				$content = Data::read($dir . '/reference-class.txt');
			} catch (Throwable) {
				$content = [];
			}

			$children[] = [
				'slug'     => $slug,
				'root'     => $dir,
				'model'    => 'reference-class',
				'template' => 'reference-class',
				'num'      => 0,
				'content'  => [
					...$content,
					'class' => $class
				]
			];
		}

		// Collect all sub-namespaces.
		// We need to add them at the top level as well,
		// otherwise there might be conflicts between class names
		// and sub-namespace names (e.g. `Http\Request.php` and `Http\Request\`)
		$namespaces = [];

		foreach (Dir::dirs($root) as $space) {
			$namespaces = [
				...$namespaces,
				...$this->childrenFromSrcFolder(
					namespace: $namespace . '\\' . $space,
					root:      $root . '/' . $space
				)
			];
		}

		return [
			[
				'slug'     => $slug = Str::slug($namespace),
				'template' => 'link',
				'parent'   => $this,
				'num'      => null,
				'content'  => [
					'title' => 'Kirby\\' . $namespace,
					'link'  => 'docs/reference/objects#' . $slug
				],
				'children' => $children
			],
			...$namespaces
		];
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
