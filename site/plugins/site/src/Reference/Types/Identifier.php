<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;
use ReferenceClassPage;
use ReflectionClass;

/**
 * A type that can be resolved to a class, method, field or helper
 */
class Identifier extends Type
{
	public function __construct(
		public string $type,
		public string|null $alias = null
	) {
		$this->type = ltrim($this->type, '\\');
	}

	/**
	 * Checks if a class, interface, trait or enum exists
	 * with exactly this name; the case is checked as well,
	 * as `class_exists()` and the like are case-insensitive
	 */
	public static function exists(string $name): bool
	{
		if (
			class_exists($name) === false &&
			interface_exists($name) === false &&
			trait_exists($name) === false
		) {
			return false;
		}

		return (new ReflectionClass($name))->getName() === $name;
	}

	/**
	 * Returns the HTML markup for the type
	 *
	 * @param $text Alternative text to display
	 * @param $linked Whether to link to the Reference page
	 */
	public function toHtml(
		string|null $text = null,
		bool $linked = true
	): string {
		if ($page = $this->toPage()) {
			$text ??= $this->toString();
			$tag    = Html::tag('code', $text, ['class' => 'type type-class']);

			if ($linked === true) {
				$tag = Html::a(
					$page->url(),
					[$tag],
					['class' => 'type-link']
				);
			}

			return $tag;
		}

		$text ??= $this->type;

		// Handle Vue components and link to Lab
		if (preg_match('/^<(k-[a-z\-]+)>$/', $this->type, $matches) === 1) {
			$tag = Html::tag('code', $text, ['class' => 'type type-vue']);

			if ($linked === true) {
				$tag =  Html::a(
					'https://lab.getkirby.com/public/lab/docs/' . $matches[1],
					[$tag],
					['class' => 'type-link']
				);
			}

			return $tag;
		}

		// Some class or interface exists in PHP in the global namespace
		if (static::exists($this->type) === true) {
			return Html::tag('code', $text, [
				'class' => 'type type-class'
			]);
		}

		return Html::tag('code', $text, ['class' => 'type']);
	}

	/**
	 * Returns the page for the identifier
	 */
	public function toPage(): ReferenceClassPage|null
	{
		$class = ltrim($this->type, '$');
		return ReferenceClassPage::findByName(
			class: $class,
			aliases: str_starts_with($this->type, '$') === true
		);
	}

	/**
	 * Return the identifier as a string
	 */
	public function toString(bool $short = false): string
	{
		$name = $this->toPage()?->name(short: false) ?? $this->type;

		return match ($short) {
			true    => static::shortName($name),
			default => $name
		};
	}
}
