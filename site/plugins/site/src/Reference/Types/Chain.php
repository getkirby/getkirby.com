<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;
use Kirby\Toolkit\A;
use ReferenceClassMethodPage;
use ReferenceClassPage;
use ReferenceFieldMethodPage;
use ReferenceHelperPage;

/**
 * A chain of an identifier callable members
 * resulting in a type, e.g. a class with chained methods
 */
class Chain extends Type
{
	public const SEPARATORS = '->|::';

	protected Identifier $class;
	protected array $methods;
	protected ReferenceClassPage|ReferenceClassMethodPage|ReferenceFieldMethodPage|ReferenceHelperPage|null $page;

	public function __construct(
		public string $type
	) {
		//:: or -> separating class and methods
		$chain         = preg_split('/' . self::SEPARATORS . '/', $type);
		$this->class   = new Identifier(array_shift($chain));
		$this->methods = $chain;
	}

	/**
	 * Return the chain as an HTML code tag
	 */
	public function toHtml(
		string|null $text = null,
		bool $linked = true
	): string {
		$page   = $this->toPage();
		$text ??= $this->toString();
		$tag    = Html::tag('code', $text, [
			'class' => 'type type-' . match (true) {
				$page instanceof ReferenceClassMethodPage => 'method',
				$page instanceof ReferenceFieldMethodPage => 'method',
				$page instanceof ReferenceHelperPage      => 'method',
				$page instanceof ReferenceClassPage       => 'class',
				default                                   => 'none'
			}
		]);

		if ($page && $linked === true) {
			$tag = Html::a(
				$page->url(),
				[$tag],
				['class' => 'type-link']
			);
		}

		return $tag;
	}

	/**
	 * Returns the final page for the chain
	 */
	public function toPage(): ReferenceClassPage|ReferenceClassMethodPage|ReferenceFieldMethodPage|ReferenceHelperPage|null
	{
		if (isset($this->page)) {
			return $this->page;
		}

		// Prevent interpreting class property access as method call
		$lastMethod = end($this->methods);

		if (
			count($this->methods) > 0 &&
			str_ends_with($lastMethod, ')') === false
		) {
			return null;
		}

		// Clean up method names
		$methods = A::map(
			$this->methods,
			fn ($method) => preg_replace('/\(.*\)$/', '', $method)
		);

		// Find helper functions first
		// as `helper` isn't actually a class but used here as flag
		if (strtolower($this->class->type) === 'helper') {
			return $this->page = ReferenceHelperPage::findByName(
				name: $methods[0]
			);
		}

		// Find base class page
		$class = $this->class->toPage();

		if ($class === null || count($this->methods) === 0) {
			return $this->page = $class;
		}

		// Find field methods
		if ($class->name(short: false) === 'Kirby\Content\Field') {
			return $this->page = ReferenceFieldMethodPage::findByName(
				name: $methods[0]
			);
		}

		// Find class methods
		return $this->page = ReferenceClassMethodPage::findByNames($class, $methods);
	}

	/**
	 * Return the chain as a string
	 */
	public function toString(): string
	{
		// Start with class name:
		// Use the short form if the class has a name (e.g. $kirby, $page),
		// otherwise use the long form (e.g. \Kirby\Cms\ModelWithContent)
		$class = $this->class->toPage();
		$short = $class?->content()->get('name')->isNotEmpty();

		if ($short === true) {
			$text = '$' . strtolower($class->name(short: true));
		}

		$text ??= $this->class->toString();

		// Omit non-class helper flag
		if ($text === 'Helper') {
			$text = null;
		}

		// Add methods to chain
		if (count($this->methods) > 0) {
			// Use -> for short form (e.g. $page->title()),
			// :: for long form (e.g. \Kirby\Cms\ModelWithContent::id())
			$glue = match ($short) {
				true    => '->',
				default => '::'
			};

			if ($text !== null) {
				$text .= $glue;
			}

			$text .= implode($glue, $this->methods);
		}

		return $text;
	}
}
