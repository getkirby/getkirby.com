<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Deprecated;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Reference\Reflectable\Tags\Throws;
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

	public function alias(): string|null
	{
		return null;
	}

	public function deprecated(): Deprecated|null
	{
		return $this->deprecated ??= Deprecated::factory($this);
	}

	public function doc(): Doc
	{
		return $this->doc ??= Doc::factory($this->reflection);
	}

	public function isDeprecated(): bool
	{
		return $this->deprecated() !== null;
	}

	/**
	 * Object has been marked as internal.
	 * Used to filter entry from the reference.
	 */
	public function isInternal(): bool
	{
		return $this->doc()->getTagByName('@internal') !== null;
	}

	/**
	 * Get `@see` tag value which references
	 * another object to refer to for more information
	 */
	public function see(): string|null
	{
		return $this->doc()->getTagByName('@see')?->value;
	}

	public function since(): Since|null
	{
		return $this->since ??= Since::factory($this);
	}

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
	 * Get the URL to the source code on GitHub
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

	public function throws(): Throws|null
	{
		return $this->throws ??= Throws::factory($this);
	}
}
