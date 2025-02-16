<?php

use Kirby\Reference\ReferencePage;
use Kirby\Reference\Reflectable\ReflectableValidator;

class ReferenceValidatorPage extends ReferencePage
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
		return new ReflectableValidator(name: $this->name());
	}
}
