<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Reference\ReferencePage;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Toolkit\Str;
use ReferenceClassPage as ReferenceClass;

class ReferenceClassMethodPage extends ReferencePage
{
	protected string|null $inherited;

	public function class(bool $short = false): string
	{
		return $this->parent()->name($short);
	}

	public function exists(): bool
	{
		return method_exists($this->class(), $this->name());
	}

	public static function findByNames($page, array $methods): Page|null
	{
		// Until we reach end of methods chain
		while (count($methods) > 0) {
			// Try to find method page
			$method = array_shift($methods);
			$page   = $page->find(Str::kebab($method));

			if ($page === null) {
				break;
			}

			// If has subsequent methods in the chain,
			// get return value and turn into class page
			if (count($methods) > 0) {
				$return = explode('|', $page->returnType())[0];
				$page   = ReferenceClass::findByName($return);

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
		$class = $this->parent()->content()->get('name')->value();
		$name  = $this->reflection()->name(class: $class);
		return parent::title()->value($name . '()');
	}

	public function reflection(): ReflectableClassMethod
	{
		return $this->reflection ??= new ReflectableClassMethod(
			$this->parent()->name(short: false),
			$this->name()
		);
	}
}
