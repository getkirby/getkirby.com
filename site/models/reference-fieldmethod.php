<?php

use Kirby\Content\Field;
use Kirby\Reference\ReferencePage;
use Kirby\Reference\Reflectable\ReflectableFieldMethod;
use Kirby\Toolkit\Str;

class ReferenceFieldMethodPage extends ReferencePage
{
	public function class(bool $short = false): string
	{
		return match ($short) {
			true  => 'Field',
			false => 'Kirby\Content\Field'
		};
	}

	public static function findByName(
		string $name
	): ReferenceFieldMethodPage|null {
		$methods = page('docs/reference/templates/field-methods');
		return $methods->find(Str::kebab($name));
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Field method'
			]
		]);
	}

	public function reflection(): ReflectableFieldMethod
	{
		return $this->reflection ??= new ReflectableFieldMethod(
			name: $this->name()
		);
	}

	public function title(): Field
	{
		return parent::title()->value($this->reflection()->name() . '()');
	}
}
