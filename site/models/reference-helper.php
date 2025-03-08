<?php

use Kirby\Content\Field;
use Kirby\Reference\Reflectable\ReflectableHelperFunction;
use Kirby\Toolkit\Str;

class ReferenceHelperPage extends ReferenceArticlePage
{
	public static function findByName(string $name): static|null
	{
		$helpers = page('docs/reference/templates/helpers');
		return $helpers->find(Str::kebab($name));
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Helper'
			]
		]);
	}

	public function title(): Field
	{
		return parent::title()->value($this->name() . '()');
	}

	public function reflection(): ReflectableHelperFunction
	{
		return $this->reflection ??= new ReflectableHelperFunction(
			name: $this->slug()
		);
	}

}
