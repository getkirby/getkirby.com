<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Reference\ReferenceSectionPage;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Toolkit\Str;
use ReferenceClassMethodPage as ReferenceClassMethod;

class ReferenceClassPage extends ReferenceSectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children = [];
		$pages    = parent::children();
		$methods  = $this->reflection()->methods();

		foreach ($methods as $method) {
			// Don't include protected or private methods
			if ($method->isPublic() === false) {
				continue;
			}

			$slug    = Str::kebab($method->getName());
			$isMagic = substr($slug, 0, 1) === '_';
			$num     = $isMagic ? null : 1;
			$content = $pages->find($slug)?->content()->toArray() ?? [];

			// Ensure that constructor method is listed,
			// while other magic methods remain unlisted
			if ($slug === '__construct') {
				$num = 0;
			}

			$children[] = [
				'slug'     => $slug,
				'model'    => 'reference-classmethod',
				'template' => 'reference-classmethod',
				'parent'   => $this,
				'content'  => $content,
				'num'      => $num
			];
		}

		// Create the actual class methods as children pages collection
		$children = Pages::factory($children, $this);

		// If the class is flagged as proxying another class,
		// get the proxied methods that are not covered by an
		// actual class method and add them
		if ($this->proxies()->isNotEmpty()) {
			foreach ($this->proxies()->yaml() as $proxy) {
				$proxied  = ReferenceClassMethod::proxied($proxy, $children);
				$children = $children->add($proxied);
			}
		}

		// Return children pages collection sorted by slug,
		// but making sure `__construct` goes first
		return $this->children = $children->sortBy(
			'isMagic',
			'desc',
			'slug',
			'asc',
			SORT_NATURAL
		);
	}

	public static function findByName(string $class): Page|null
	{
		$class = ltrim($class, '\\');
		$class = ReferenceClassAliasesPage::resolve($class);

		// don't even start to look if the class does not exist in Kirby
		if (class_exists($class) === false) {
			return null;
		}

		$objects = 'docs/reference/objects';
		$class   = explode('\\', $class);

		if (count($class) > 2) {
			$namespace = implode('//', array_slice($class, 1, -1));
			$class     = array_slice($class, -1)[0];
			$id        = Str::slug($namespace) . '/' . Str::kebab($class);

			if ($page = page($objects . '/' . $id)) {
				if ($page->intendedTemplate()->name() === 'link') {
					$page = page($page->link());
				}

				return $page;
			}
		}

		return null;
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Object',
				'title' => $this->name()
			]
		]);
	}

	public function name(bool $short = false): string
	{
		$name = $this->content()->get('name');

		if ($short === true && $name->isNotEmpty()) {
			return $name->value();
		}

		return $this->reflection()->name(short: $short);
	}

	public function searchbyline(): Field
	{
		return parent::searchbyline()->value(
			'Class <code>' . $this->class() . '</code>'
		);
	}

	public function title(): Field
	{
		$name = $this->name(short: true);

		if ($this->content()->get('name')->isNotEmpty()) {
			$name = '$' . strtolower($name);
		}

		return parent::title()->value($name);
	}

	public function reflection(): ReflectableClass
	{
		if ($this->reflection !== null) {
			return $this->reflection;
		}

		// get class name as defined in content file
		$class = $this->class()->value();

		if ($class === null) {
			throw new Exception('Content file of "' . $this->id() . '" needs to define a "class" field');
		}

		return $this->reflection = new ReflectableClass($class);
	}
}
