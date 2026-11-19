<?php

use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Content\FieldMethods;
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
		$methods  = $this->getNativeMethods($pages);

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

	protected function getNativeMethods(Pages $pages): array
	{
		$methods    = [];
		$reflection = new ReflectionClass(Field::class);
		$trait      = (new ReflectionClass(FieldMethods::class))->getFileName();

		foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			$name = $method->getName();

			if (substr($name, 0, 1) === '_') {
				continue;
			}

			// everything the `Field` class picks up beyond its
			// `FieldMethods` trait is only a field method if it
			// has been documented manually
			if (
				$method->getFileName() !== $trait &&
				$pages->find(Str::kebab($name)) === null
			) {
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
