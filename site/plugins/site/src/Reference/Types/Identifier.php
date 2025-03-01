<?php

namespace Kirby\Reference\Types;

use Kirby\Cms\Html;
use Kirby\Toolkit\A;
use ReferenceClassMethodPage;
use ReferenceClassPage;
use ReferenceFieldMethodPage;
use ReferenceHelperPage;
use ReflectionClass;

/**
 * A type that can be resolved to a class, method, field or helper
 */
class Identifier extends Type
{
	public function __construct(
		public string $type,
	) {
		$this->type = ltrim($this->type, '\\');
	}

	protected function page(): ReferenceClassPage|ReferenceClassMethodPage|ReferenceFieldMethodPage|ReferenceHelperPage|null
	{
		//:: or -> separating class and method
		$chain  = preg_split('/::|->/', $this->type);
		$class  = array_shift($chain);

		if (count($chain) > 0) {
			// Remove leading $
			$class = ltrim($class, '$');

			if (strtolower($class) === 'field') {
				return ReferenceFieldMethodPage::findByName($chain[0]);
			}

			if (strtolower($class) === 'helper') {
				return ReferenceHelperPage::findByName($chain[0]);
			}
		}

		// Get page for base class/object
		if ($page = ReferenceClassPage::findByName($class)) {

			// If type is only the class, return the page
			if (count($chain) === 0) {
				return $page;
			}

			// Clean up method names
			$methods = A::map(
				$chain,
				fn ($method) => preg_replace('/\(.*\)$/', '', $method)
			);

			// If method page can be found by chain, return that page
			return ReferenceClassMethodPage::findByNames($page, $methods);
		}

		return null;
	}

	public function toHtml(
		string|null $text = null,
		bool $linked = true
	): string {
		$text ??= $this->type;

		// assume, it’s a class or class method name
		// (starting with a letter, \ or $)
		if (preg_match('/^[A-Z\\\$]/', $this->type) === 1) {

			// check if reference page for class or class method exists
			if ($page = $this->page()) {
				$tag = Html::tag('code', $text, [
					'class' => 'type type-' . match (true) {
						$page instanceof ReferenceClassMethodPage => 'method',
						default                                   => 'class'
					}
				]);

				if ($linked === true) {
					$tag = Html::a(
						$page->url(),
						[$tag],
						['class' => 'type-link']
					);
				}

				return $tag;
			}
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
}
