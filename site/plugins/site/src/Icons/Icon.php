<?php

namespace Kirby\Icons;

use DOMDocument;
use DOMXPath;
use Kirby\Cms\App;
use Kirby\Toolkit\Str;

/**
 * Provides icon SVG markup from local SVGs
 * or from the Kirby Panel SVG sprite
 */
class Icon
{
	public function __construct(
		public string $name,
		public string|null $title = null
	) {
	}

	/**
	 * Adds necessary attributes to the SVG markup
	 * for accessibility
	 */
	protected function normalize(string $svg): string
	{
		$svg = new SimpleXmlElement($svg);

		if ($this->title) {
			$id   = Str::uuid();
			$svg['role'] = 'img';
			$svg['aria-labelledby'] = $id;
			$svg->prependChild('title', $this->title)->addAttribute('id', $id);
		} elseif (isset($svg->title) === false) {
			$svg['aria-hidden'] = 'true';
		}

		return $svg->asXML();
	}

	/**
	 * Returns the SVG string for the icon
	 */
	public function svg(): string|null
	{
		$svg   = $this->svgFromLocal();
		$svg ??= $this->svgFromPanel();
		return $svg;
	}

	/**
	 * Returns the SVG string from a local file in `assets/icons`
	 */
	protected function svgFromLocal(): string|null
	{
		$svg = svg('assets/icons/' . $this->name . '.svg');

		if ($svg === false) {
			return null;
		}

		return $svg;
	}

	/**
	 * Returns the SVG string from the Kirby Panel SVG sprite
	 */
	protected function svgFromPanel(): string|null
	{
		$root  = App::instance()->root() . '/kirby/panel/dist/img/icons.svg';
		$dom   = new DOMDocument();
		$dom->load(realpath($root));
		$xpath = new DOMXPath($dom);
		$xpath->registerNamespace('svg', 'http://www.w3.org/2000/svg');
		$panel = $xpath->query('//svg:symbol[@id="icon-' . $this->name . '"]');

		if ($panel->count() === 0) {
			return null;
		}

		/**
		 * @var \DOMElement $icon
		 */
		$icon = $panel->item(0);

		if ($use = $icon->getElementsByTagName('use')->item(0)) {
			$name = $use->getAttribute('href');
			$name = Str::after($name, '#icon-');
			return (new Icon($name, $this->title))->svg();
		}

		$viewBox = $icon->getAttribute('viewBox');
		$content = '';
		foreach ($icon->childNodes as $child) {
			$content .= $child->ownerDocument->saveXML($child);
		}

		return '<svg data-type="' . $this->name . '" xmlns="http://www.w3.org/2000/svg" viewBox="' . $viewBox . '">' . trim($content) . '</svg>';
	}

	/**
	 * Returns the SVG markup for the icon
	 */
	public function toString(): string|null
	{
		$svg = $this->svg();

		if ($svg === null) {
			return null;
		}

		return $this->normalize($svg);
	}
}

