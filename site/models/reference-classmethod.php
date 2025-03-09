<?php

use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Toolkit\Str;
use ReferenceClassPage as ReferenceClass;

class ReferenceClassMethodPage extends ReferenceArticlePage
{
	/**
	 * Find a method page from a class
	 * following a chain of method names
	 */
	public static function findByNames(
		ReferenceClass $page,
		array $methods
	): ReferenceClassMethodPage|null {
		// until we reach end of methods chain
		while (count($methods) > 0) {
			// try to find method page
			$method = array_shift($methods);
			$page   = $page->find(Str::kebab($method));

			if ($page === null) {
				break;
			}

			// if there are subsequent methods in the chain,
			// get return value and turn into class page
			if (count($methods) > 0) {
				$returns = $page->reflection()->returns();
				$returns = explode('|', $returns->types()->toString())[0];
				$page    = ReferenceClass::findByName($returns);

				if ($page === null) {
					break;
				}
			}
		}

		return $page;
	}

	public function isMagic(): bool
	{
		return $this->reflection()->isMagic();
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Method'
			]
		]);
	}

	/**
	 * Returns all methods of the proxied
	 * class that are not already part
	 * of the methods collection
	 *
	 * @param string $source class name that is proxied
	 * @param \Kirby\Cms\Pages $methods existing methods collection
	 */
	public static function proxied(string $source, Pages $methods): Pages
	{
		if ($proxy = ReferenceClass::findByName($source)) {
			$proxied    = $proxy->children();
			$additional = array_diff(
				$proxied->values(fn ($p) => $p->slug()),
				$methods->values(fn ($p) => $p->slug())
			);

			return $proxied->find(...$additional);
		}

		return new Pages();
	}

	public function title(): Field
	{
		$name = $this->reflection()->name();
		return parent::title()->value($name . '()');
	}

	public function reflection(): ReflectableClassMethod
	{
		return $this->reflection ??= new ReflectableClassMethod(
			class:      $this->parent()->name(short: false),
			classalias: $this->parent()->content()->get('name')->value(),
			method:     $this->name()
		);
	}
}
