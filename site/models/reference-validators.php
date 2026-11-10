<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class ReferenceValidatorsPage extends ReferenceSectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children   = [];
		$validators = $this->getValidators();
		$pages      = parent::children();

		foreach ($validators as $validator) {
			$children[] = [
				'slug'     => $slug = Str::kebab($validator),
				'num'      => 0,
				'model'    => 'reference-validator',
				'template' => 'reference-validator',
				'parent'   => $this,
				'content'  => [
					...$pages->find($slug)?->content()->toArray() ?? [],
					'title' => $validator
				]
			];
		}

		return $this->children = Pages::factory($children, $this);
	}

	/**
	 * Returns the names of all default validators
	 */
	protected function getValidators(): array
	{
		$reflection = new ReflectionClass(V::class);
		$validators = [];
		$methods    = $reflection->getMethods(
			ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC
		);

		foreach ($methods as $method) {
			if ($method->getDeclaringClass()->getName() !== V::class) {
				continue;
			}

			if ((string)$method->getReturnType() !== 'bool') {
				continue;
			}

			if (($method->getParameters()[0] ?? null)?->getName() !== 'value') {
				continue;
			}

			$validators[] = $method->getName();
		}

		sort($validators);

		return $validators;
	}
}
