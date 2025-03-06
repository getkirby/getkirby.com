<?php

namespace Kirby\Reference;

use DefaultPage;
use Kirby\Cms\Pages;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Template\Template;

abstract class ReferencePage extends DefaultPage
{
	protected $reflection = null;

	public function intro(): Field
	{
		// prefer intro defined in content file
		if ($this->content()->has('intro')) {
			return $this->content()->get('intro');
		}

		// otherwise try to get summary from DocBlock in code
		return new Field($this, 'intro', $this->reflection()?->summary());
	}

	public function isDeprecated(): bool
	{
		return $this->reflection()?->isDeprecated() ?? false;
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
