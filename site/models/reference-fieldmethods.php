<?php

use Kirby\Cms\Pages;
use Kirby\Reference\SectionPage;

class ReferenceFieldMethodsPage extends SectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children = [];
		$pages	= parent::children();
		$methods  = array_merge(
			$this->getDynamicMethods(), 
			$this->getNativeMethods()
		);

		foreach ($methods as $name => $reflection) {
			$slug = Str::kebab($name);

			if ($page = $pages->find($slug)) {
				$content = $page->content()->toArray();
			} else {
				$content = [];
			}

			$children[] = [
				'slug'	 => $slug,
				'num'	  => 0,
				'template' => 'reference-fieldmethod',
				'model'	=> 'reference-fieldmethod',
				'parent'   => $this,
				'content'  => $content
			];
		}

		return $this->children = Pages::factory($children, $this)->sortBy('title', 'asc');
	}

	protected function getDynamicMethods()
	{
		$methods = (include $this->kirby()->root('kirby') . '/config/methods.php')($this->kirby());

		foreach ($methods as $key => $function) {
			$methods[$key] = new ReflectionFunction($function);
		}

		return $methods;
	}

	protected function getNativeMethods()
	{
		$methods	= [];
		$reflection = new ReflectionClass(Field::class);

		foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			$name = $method->getName();

			if (substr($name, 0, 1) !== '_') {
				$methods[$name] = $method;
			}
		}

		return $methods;
	}
	
}
