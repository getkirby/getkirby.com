<?php

use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\ReflectableFieldMethod;
use Kirby\Toolkit\Str;

class ReferenceFieldMethodsPage extends ReferenceSectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children = [];
		$pages    = parent::children();
		$methods  = $this->getNativeMethods();

		foreach ($methods as $name => $reflection) {
			$children[] = [
				'slug'     => $slug = Str::kebab($name),
				'num'      => 0,
				'template' => 'reference-fieldmethod',
				'model'    => 'reference-fieldmethod',
				'parent'   => $this,
				'content'  => $pages->find($slug)?->content()->toArray() ?? []
			];
		}

		return $this->children = Pages::factory($children, $this)->sortBy('title', 'asc');
	}

	protected function getNativeMethods(): array
	{
		$methods    = [];
		$reflection = new ReflectionClass(Field::class);

		foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			$name = $method->getName();

			if (substr($name, 0, 1) === '_') {
				continue;
			}

			// aliases are listed on the page of the method they point to
			if ((new ReflectableFieldMethod($name))->isAlias() === true) {
				continue;
			}

			$methods[$name] = $method;
		}

		return $methods;
	}
}
