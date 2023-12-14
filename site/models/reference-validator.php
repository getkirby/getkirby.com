<?php

use Kirby\Content\Field;
use Kirby\Reference\ReflectionPage;
use Kirby\Toolkit\V;

class ReferenceValidatorPage extends ReflectionPage
{
	public function call(): string
	{
		return 'V::' . parent::call();
	}

	public function exists(): bool
	{
		return isset(V::$validators[$this->name()]);
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Validator'
			]
		]);
	}

	public function onGitHub(string $path = ''): Field
	{
		return parent::onGitHub('src/Toolkit/V.php');
	}

	protected function reflection(): ReflectionFunction
	{
		return $this->reflection ??= new ReflectionFunction(V::$validators[$this->name()]);
	}
}
