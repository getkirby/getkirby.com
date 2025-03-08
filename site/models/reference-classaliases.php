<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;

class ReferenceClassAliasesPage extends ReferenceSectionPage
{
	protected static array $aliases;

	protected static function aliases(): array
	{
		return static::$aliases ??= require kirby()->root('kirby') . '/config/aliases.php';
	}

	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$aliases  = $this->aliases();
		$children = [];

		ksort($aliases);

		foreach ($aliases as $alias => $class) {
			if (
				count(explode('\\', $alias)) < 2 &&
				$page = ReferenceClassPage::findByName($class)
			) {
				$children[] = [
					'slug'     => Str::kebab($alias),
					'model'    => 'link',
					'template' => 'link',
					'parent'   => $this,
					'num'      => 0,
					'content'  => [
						'title' => ucfirst($alias),
						'intro' => '&rarr; ' . $class,
						'link'  => $page->id()
					],
				];
			}
		}

		return $this->children = Pages::factory($children, $this);
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Class'
			]
		]);
	}

	public static function resolve(string $name): string
	{
		return static::aliases()[Str::lower($name)] ?? $name;
	}
}
