<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Reference\SectionPage;
use Kirby\Toolkit\Str;
use ReferenceClassMethodPage as ReferenceClassMethod;

class ReferenceClassPage extends SectionPage
{
	public function alias(): Field
	{
		static $aliases = require $this->kirby()->root('kirby') . '/config/aliases.php';

		$alias = array_search($this->name(), $aliases);
		return new Field($this, 'alias', $alias ?: null);
	}

	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children   = [];
		$pages      = parent::children();
		$reflection = $this->reflection();
		$methods    = $reflection->getMethods();

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
		$children = Pages::factory($children, $this)->filterBy('exists', true);

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

	public function exists(): bool
	{
		return class_exists($this->name()) === true ||
			   trait_exists($this->name()) === true;

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

	public function isStatic(): bool
	{
		return method_exists($this->name(), '__construct') === false;
	}

	public function isTrait(): bool
	{
		return $this->reflection()?->isTrait();
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
		if ($short !== true) {
			// get class name as defined in content file
			$class = $this->class()->value();

			if ($class === null) {
				throw new Exception('Content file of "' . $this->id() . '" needs to define a "class" field');
			}

			return $class;
		}

		// prefer content field `name`
		return
			$this->content()->get('name')->value() ??
			$this->reflection()->getShortName();
	}

	public function onGitHub(string $path = ''): Field
	{
		$path = str_replace('Kirby\\', '', $this->name());
		$path = str_replace('\\', '/', $path);
		return parent::onGitHub('src/' . $path . '.php');
	}

	public function searchbyline(): Field
	{
		return parent::searchbyline()->value(
			'Class <code>' . $this->class() . '</code>'
		);
	}

	public function title(): Field
	{
		if ($this->content()->has('title')) {
			return parent::title();
		}

		$title = $this->name(true);
		return parent::title()->value($title);
	}

	protected function reflection(): ReflectionClass
	{
		return $this->reflection ??= new ReflectionClass($this->name());
	}

}
