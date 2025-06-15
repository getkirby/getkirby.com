<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Deprecated;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Reference\Reflectable\Tags\Throws;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use Reflector;

/**
 * Base class for all reflectable entities
 */
abstract class Reflectable
{
	public Doc $doc;
	public Reflector $reflection;

	protected Deprecated|null $deprecated = null;
	protected Since|null $since = null;
	protected Throws|null $throws = null;

	/**
	 * Returns the name alias of the reflectable
	 */
	public function alias(): string|null
	{
		return null;
	}

	/**
	 * Returns the deprecated tag, if present
	 */
	public function deprecated(): Deprecated|null
	{
		return $this->deprecated ??= Deprecated::factory($this);
	}

	/**
	 * Returns the doc block
	 */
	public function doc(): Doc
	{
		return $this->doc ??= Doc::factory($this->reflection);
	}

	/**
	 * Returns an example code block from the doc block
	 */
	public function examples(): string|null
	{
		$node = $this->doc()->getTextNodes()[0] ?? null;

		if ($node instanceof PhpDocTextNode) {
			$blocks   = explode(PHP_EOL . PHP_EOL, $node->text);
			$examples = A::filter(
				$blocks,
				fn ($block) => Str::startsWith($block, '```')
			);

			return implode(PHP_EOL . PHP_EOL, $examples);
		}

		return null;
	}

	/**
	 * Returns whether the entity is deprecated
	 */
	public function isDeprecated(): bool
	{
		return $this->deprecated() !== null;
	}

	/**
	 * Returns whether the entity has been marked as internal
	 */
	public function isInternal(): bool
	{
		return $this->doc()->getTagByName('@internal') !== null;
	}

	/**
	 * Returns whether the entity has been marked as unstable
	 */
	public function isUnstable(): bool
	{
		return $this->doc()->getTagByName('@unstable') !== null;
	}

	/**
	 * Returns the `@see` tag value which references
	 * another entity to refer to for more information
	 */
	public function see(): string|null
	{
		return $this->doc()->getTagByName('@see')?->value;
	}

	/**
	 * Returns the `@since` tag, if present
	 */
	public function since(): Since|null
	{
		return $this->since ??= Since::factory($this);
	}

	/**
	 * Returns the summary/description from the doc block
	 */
	public function summary(): string|null
	{
		$node = $this->doc()->getTextNodes()[0] ?? null;

		if ($node instanceof PhpDocTextNode) {
			$text = explode(PHP_EOL . PHP_EOL, $node->text)[0];
			$text = str_replace(PHP_EOL, ' ', $text);
			return trim($text);
		}

		return null;
	}

	/**
	 * Returns the URL to the source code on GitHub
	 * incl. line number if available
	 */
	public function source(): string|null
	{
		if (method_exists($this, 'sourcePath') === false) {
			return null;
		}

		$url  = option('github.url') . '/kirby/tree/' . App::version();
		$url .= '/' . $this->sourcePath();

		if (method_exists($this, 'sourceLine') === true) {
			$url .= '#L' . $this->sourceLine();
		}

		return $url;
	}

	/**
	 * Returns the `@throws` tags, if present
	 */
	public function throws(): Throws|null
	{
		return $this->throws ??= Throws::factory($this);
	}
}
