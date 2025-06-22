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
	 * Returns the HTML markup for the type
	 *
	 * @param string|null $text Alternative text to display
	 * @param bool $linked Whether to link to the Reference page
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

		// Some class exists in PHP in the global namespace.
		// The second check is done to ensure correct case,
		// as `class_exists()` is not case-sensitive.
		if (
			class_exists($this->type) === true &&
			(new ReflectionClass($this->type))->getName() === $this->type
		) {
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
	public function toString(): string
	{
		return $this->toPage()?->name(short: false) ?? $this->type;
	}
}
