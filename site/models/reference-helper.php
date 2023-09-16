<?php

use Kirby\Content\Field;
use Kirby\Reference\ReflectionPage;
use Kirby\Toolkit\Str;

class ReferenceHelperPage extends ReflectionPage
{
	public function exists(): bool
	{
		return function_exists($this->slug());
	}

	public static function findByName(string $name): ReferenceHelperPage|null
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

	public function onGitHub(string $path = ''): Field
	{
		return parent::onGitHub('config/helpers.php');
	}

	public function title(): Field
	{
		return parent::title()->value($this->name() . '()');
	}

	protected function reflection(): ReflectionFunction
	{
		return $this->reflection ??= new ReflectionFunction($this->slug());
	}

}
