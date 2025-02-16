<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Deprecated;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Reference\Reflectable\Tags\Throws;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;
use Reflector;
use Throwable;

abstract class Reflectable
{
	public DocBlock $doc;
	public Reflector $reflection;

	public function alias(): string|null
	{
		return null;
	}

	public function deprecated(): Deprecated|null
	{
		return Deprecated::factory($this);
	}

	public function isDeprecated(): bool
	{
		return $this->deprecated() !== null;
	}

	public function isInternal(): bool
	{
		$tag = $this->doc->getTagsByName('internal')[0] ?? null;
		return $tag !== null;
	}

	public function summary(): string|null
	{
		$summary = $this->doc->getSummary();
		$summary = trim($summary);
		$summary = str_replace(PHP_EOL, ' ', $summary);

		if ($summary === '/') {
			$summary = null;
		}

		return $summary;
	}

	protected function setDoc(): void
	{
		try {
			$comment   = $this->reflection->getDocComment();
			$this->doc = DocBlockFactory::createInstance()->create($comment);
		} catch (Throwable) {
			$this->doc = new DocBlock();
		}
	}

	public function since(): Since|null
	{
		return Since::factory($this);
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
		return Throws::factory($this);
	}
}
