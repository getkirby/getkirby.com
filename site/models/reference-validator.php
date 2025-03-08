<?php

use Kirby\Reference\Reflectable\ReflectableValidator;

class ReferenceValidatorPage extends ReferenceArticlePage
{
	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Validator'
			]
		]);
	}

	public function reflection(): ReflectableValidator
	{
		return $this->reflection ??= new ReflectableValidator(
			name: $this->name()
		);
	}
}
