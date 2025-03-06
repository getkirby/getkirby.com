<?php

use Kirby\Reference\ReferencePage;
use Kirby\Reference\Reflectable\ReflectableCoreComponent;

class ReferenceComponentPage extends ReferencePage
{
	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Core component'
			]
		]);
	}

	public function name(): string
	{
		return $this->content()->get('methodName')->or(parent::name());
	}

	public function reflection(): ReflectableCoreComponent
	{
		return $this->reflection ??= new ReflectableCoreComponent(
			name: $this->name()
		);
	}
}
