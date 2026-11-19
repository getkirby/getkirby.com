<?php

use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Template\Template;
use Kirby\Toolkit\Str;

class ReferenceQuickLinkPage extends DefaultPage
{
	/**
	 * Creates children collection from `menu` content field
	 */
	public function children(): Pages
	{
		return $this->children ??= Pages::factory(
			static::childrenFromContentField($this->menu()),
			$this
		);
	}

	/**
	 * Returns quicklinks children array for field values
	 */
	public static function childrenFromContentField(Field $field): array
	{
		$children = [];

		if ($field->isNotEmpty()) {
			foreach ($field->yaml() as $menu) {
				$children[] = match ($menu) {
					'--' => [
						'slug'     => Str::random(3),
						'template' => 'separator',
						'num'      => 0
					],
					// the full path keeps the slug unique next to
					// sibling pages (e.g. the namespaces of the classes)
					default => [
						'slug'     => Str::slug($menu),
						'model'    => 'reference-quicklink',
						'template' => 'reference-quicklink',
						'num'      => 0,
						'content'  => ['link'  => 'docs/reference/' . $menu]
					]
				};
			}
		}

		return $children;
	}

	public function menuUrl(): string
	{
		return $this->link()->toUrl();
	}

	public function template(): Template
	{
		return $this->kirby()->template('link');
	}

	public function title(): Field
	{
		$title = $this->content()->get('title');

		if ($title->isNotEmpty()) {
			return $title;
		}

		$link = $this->link()->toPage();
		return new Field($this, 'title', $link ? $link->title() : null);
	}
}
