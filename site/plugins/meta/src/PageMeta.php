<?php

namespace Kirby\Meta;

use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Content\Field;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Tpl;

class PageMeta
{
	public array $data = [];

	public $defaults = [
		'robots' => true,
	];

	public function __construct(
		protected Page $page
	)
	{
		// Get metadata from page model
		if (method_exists($this->page, 'metadata') === true) {
			$this->data = $this->page->metadata();
		}
	}

	public function __call($name, $arguments)
	{
		return $this->get(strtolower($name));
	}

	public function get(string $key, bool $fallback = false): Field
	{
		// From content file...
		$key   = strtolower($key);
		$field = $this->page->content()->get($key);

		if ($field->exists() === true) {
			return $field;
		}

		// From page model...
		if (array_key_exists($key, $this->data) === true) {
			return new Field($this->page, $key, $this->data[$key]);
		}

		// From site as fallback...
		if ($fallback === true) {
			$fallback = $this->page->site()->content()->get($key);

			if ($fallback->exists()) {
				return $fallback;
			}
		}

		return new Field($this->page, $key, null);
	}

	public function jsonld(): string
	{
		$html = [];
		$json = [
			'@context' => 'https://schema.org',
			'@graph' => [
				[
					'@type'  => 'Organization',
					'name'   => 'Kirby',
					'url'    => url(),
					'logo'   => url('/assets/images/kirby-signet.svg'),
					'sameAs' => [
						'https://mastodon.social/@getkirby',
						'https://bsky.app/profile/getkirby.com',
						'https://www.linkedin.com/company/getkirby'
					],
				],
				[
					'@type' => 'WebSite',
					'url'   => url(),
					'potentialAction' => [
						[
							'@type'       => 'SearchAction',
							'target'      => url('search') . '?q={search_term_string}',
							'query-input' => 'required name=search_term_string',
						],
					],
				],
			],
		];

		return Tpl::load(__DIR__ . '/templates/json.php', compact('json'));
	}

	public function opensearch(): string
	{
		return Html::tag('link', null, [
			'rel'   => 'search',
			'type'  => 'application/opensearchdescription+xml',
			'title' => $this->page->site()->title(),
			'href'  => url('/open-search.xml'),
		]) . PHP_EOL;
	}

	public function priority(): float
	{
		$priority = $this->get('priority')->or(0.5)->value();
		return (float)min(1, max(0, $priority));
	}

	public function robots(): string
	{
		$html   = [];
		$robots = $this->get('robots', true);

		if ($robots->isNotEmpty()) {
			$html[] = Html::tag('meta', null, [
				'name'    => 'robots',
				'content' => $robots->value(),
			]);
		}

		$html[] = Html::tag('link', null, [
			'rel'  => 'canonical',
			'href' => $this->page->url(),
		]);

		return implode(PHP_EOL, $html) . PHP_EOL;
	}

	public function social(): string
	{
		$html = [];
		$meta = [];
		$og   = [];
		$site = $this->page->site();

		// Basic OpenGraph tags
		$og['og:site_name'] = $site->title()->value();
		$og['og:url']       = $this->page->url();
		$og['og:type']      = 'website';
		$og['og:title']     = $this->get('ogtitle')->or($this->page->title());

		// Meta and OpenGraph description
		$description = $this->get('description', true);

		if ($description->isNotEmpty()) {
			$og['og:description'] = $description->excerpt(200);
			$meta['description']  = $description->excerpt(160);
		}

		// Image
		if ($thumbnail = $this->thumbnail()) {
			$og['og:image'] = url($thumbnail->url());

			if ($thumbnail->alt()->isNotEmpty()) {
				$og['og:image:alt'] = $thumbnail->alt()->value();
			}
		}

		return Tpl::load(
			__DIR__ . '/templates/social.php',
			compact('meta', 'og')
		);
	}

	public function thumbnail(): File|null
	{
		return Thumbnail::file($this->page, $this);
	}
}
