<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;

/**
 * A type composed of other types, e.g. a generic like
 * `array<string, Kirby\Cms\Page>`, an array shape
 * or a callable signature
 */
class Compound extends Type
{
	/**
	 * Returns the outer type, e.g. `list` for `list<int>`
	 */
	public function base(): string
	{
		return preg_replace('/[<{(\[].*$/s', '', $this->type);
	}

	/**
	 * Returns the generic type of the outer type,
	 * e.g. `array` for `list<int>` or `Page[]`
	 */
	public function kind(): string|null
	{
		if (str_ends_with($this->type, '[]') === true) {
			return 'array';
		}

		$base = $this->base();

		return match (true) {
			static::generic($base) !== null => static::generic($base),
			Identifier::exists($base)       => 'class',
			default                         => null
		};
	}

	/**
	 * Returns the type as an HTML code tag
	 * with links to the classes in it
	 */
	public function toHtml(
		string|null $text = null,
		bool $linked = true
	): string {
		$kind = $this->kind();
		$html = match ($text) {
			null    => $this->toLinkedHtml($linked),
			default => Html::encode($text)
		};

		return Html::tag('code', [$html], [
			'class' => 'type type-compound' . ($kind !== null ? ' type-' . $kind : '')
		]);
	}

	/**
	 * Returns the escaped type with all fully
	 * qualified class names linked to their reference page
	 */
	protected function toLinkedHtml(bool $linked): string
	{
		return preg_replace_callback(
			'/[a-z_]\w*(?:\\\\[a-z_]\w*)+/i',
			function (array $match) use ($linked): string {
				$page = (new Identifier($match[0]))->toPage();

				if ($page === null || $linked === false) {
					return $match[0];
				}

				return Html::a($page->url(), $match[0]);
			},
			Html::encode($this->type)
		);
	}
}
