<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Deprecated;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Reference\Reflectable\Tags\Throws;
use Reflector;

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
		return $this->doc ??= Doc::factory($this);
	}

	public function isDeprecated(): bool
	{
		return $this->deprecated() !== null;
	}

	public function isInternal(): bool
	{
		return $this->doc()->getTagByName('@internal') !== null;
	}

	public function summary(): string|null
	{
		$nodes = $this->doc()->getTextNodes();
		$nodes = array_map(
			fn ($node) => str_replace(PHP_EOL, ' ', $node->text),
			$nodes
		);

		return implode(PHP_EOL . PHP_EOL, $nodes);
	}
	public function since(): Since|null
	{
		return $this->since ??= Since::factory($this);
	}

	public function source(): string
	{
		$url  = option('github.url') . '/kirby/tree/' . App::version();
		$url .= '/' . $this->sourcePath();

		if (method_exists($this, 'sourceLine') === true) {
			$url .= '#L' . $this->sourceLine();
		}

		return $url;
	}

	abstract protected function sourcePath(): string;

	public function throws(): Throws|null
	{
		return $this->throws ??= Throws::factory($this);
	}
}
