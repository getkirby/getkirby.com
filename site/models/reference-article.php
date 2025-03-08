<?php

use Kirby\Content\Field;
use Kirby\Reference\Reflectable\Tags\Deprecated;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Template\Template;
use Kirby\Toolkit\Str;

class ReferenceArticlePage extends DefaultPage
{
	protected $reflection = null;

	/**
	 * Get the deprecated tag either from the
	 * content field or the reflection
	 */
	public function deprecated(): Deprecated|null
	{
		if ($deprecated = $this->content()->get('deprecated')->value()) {
			$deprecated = Str::split($deprecated, '|');
			return new Deprecated(
				version: $deprecated[0] ?? null,
				description: $deprecated[1] ?? null
			);
		}

		if ($reflection = $this->reflection()) {
			return $reflection->deprecated();
		}

		return null;
	}

	public function intro(): Field
	{
		// prefer intro defined in content file
		$intro = $this->content()->get('intro')->value();

		// otherwise try to get summary from DocBlock in code
		$intro ??= $this->reflection()?->summary();

		// add alias reference
		if ($see = $this->reflection()?->see()) {
			$intro .= PHP_EOL . PHP_EOL . 'Alias for `' . $see . '`';
		}

		return new Field($this, 'intro', $intro);
	}

	public function isDeprecated(): bool
	{
		return $this->deprecated() !== null;
	}

	public function isEntry(): bool
	{
		return $this->isDeprecated() === false && $this->isInternal() === false;
	}

	public function isInternal(): bool
	{
		return $this->reflection()?->isInternal() ?? false;
	}

	public function metadata(): array
	{
		return [
			'description' => strip_tags($this->intro()->kirbytags()),
			'thumbnail' => [
				'lead'  => $this->metaLead(page('docs/reference'), 'Reference')
			]
		];
	}

	public function name(): string
	{
		return preg_replace_callback(
			'!-([a-z])!',
			fn ($matches) => strtoupper($matches[1]),
			$this->slug()
		);
	}

	public function reflection()
	{
		return null;
	}

	/**
	 * Get the since tag either from the
	 * content field or the reflection
	 */
	public function since(): Since|null
	{
		if ($since = $this->content()->get('since')->value()) {
			return new Since($since);
		}

		if ($reflection = $this->reflection()) {
			return $reflection->since();
		}

		return null;
	}

	/**
	 * Get the source code URL
	 */
	public function source(): string|null
	{
		if ($reflection = $this->reflection()) {
			return $reflection->source();
		}

		return null;
	}

	/**
	 * If a dedicated template exist, use it.
	 * Otherwise fall back to `reference-article` template.
	 */
	public function template(): Template
	{
		// If template exists, use it
		if ($this->intendedTemplate() === parent::template()) {
			return parent::template();
		}

		return $this->kirby()->template('reference-article');
	}
}
