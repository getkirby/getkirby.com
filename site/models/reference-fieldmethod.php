<?php

use Kirby\Cms\Field;
use Kirby\Toolkit\Str;
use Kirby\Reference\ReflectionPage;

class ReferenceFieldMethodPage extends ReflectionPage
{
	/**
	 * Returns aliases for field method
	 */
	public function aliases(): array
	{
		return array_keys(Field::$aliases, $this->name());
	}

	/**
	 * Returns example how field method would be called
	 */
	public function call(): string
	{
		return '$field->' . parent::call();
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

	/**
	 * Returns the URL to the source code on GitHub
	 */
	public function onGitHub(string $path = ''): Field
	{
		if ($this->reflection() instanceof ReflectionMethod) {
			return parent::onGitHub('src/Cms/Field.php');
		}

		return parent::onGitHub('config/methods.php');
	}

	/**
	 * Returns an array with all parameter info.
	 * Omits the inserted `$field` parameter from refleciton info as
	 * it does not get passed on the call
	 */
	public function parameters(): array
	{
		$parameters = parent::parameters();

		// Kirby automatically inserts $field as first parameter on all methods
		// defined in `kirby/config/methods.php`. The reflection picks up this
		// parameter, however, we need to remove it from the list as it does not
		// actually get passed when calling the field method
		if (($parameters[0]['name'] ?? null) === '$field') {
			array_shift($parameters);
		}

		return $parameters;
	}

	/**
	 * Returns title based on field method call
	 */
	public function title(): Field
	{
		return parent::title()->value('$field->' . $this->name() . '()');
	}

	/**
	 * Helper for reflection object
	 */
	protected function reflection(): ReflectionFunction|ReflectionMethod|null
	{
		if (isset($this->reflection) === true) {
			return $this->reflection;
		}

		$key = strtolower($this->name());

		if (isset(Field::$methods[$key]) === true) {
			return $this->reflection = new ReflectionFunction(Field::$methods[$key]);
		}

		if (method_exists(Field::class, $this->name()) === true) {
			return $this->reflection = new ReflectionMethod(Field::class, $this->name());
		}

		return null;
	}

}
