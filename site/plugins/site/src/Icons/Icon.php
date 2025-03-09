<?php

namespace Kirby\Icons;

use Kirby\Cms\App;
use Kirby\Toolkit\Str;

/**
 * Provides icon SVG markup from local SVGs
 * or from the Kirby Panel SVG sprite
 */
class Icon
{
	protected static SimpleXmlElement $panel;

	public function __construct(
		public string $name,
		public string|null $title = null
	) {
	}

	/**
	 * Returns the SVG string from a local file in `assets/icons`
	 */
	public function getFromLocal(): SimpleXmlElement|null
	{
		$svg = svg('assets/icons/' . $this->name . '.svg');

		if ($svg === false) {
			return null;
		}

		return new SimpleXmlElement($svg);
	}

	/**
	 * Returns the SVG string from the Kirby Panel SVG sprite
	 */
	public function getFromPanel(): SimpleXmlElement|null
	{
		// load the Panel SVG sprite
		if (isset(static::$panel) === false) {
			$root  = App::instance()->root();
			$root .= '/kirby/panel/dist/img/icons.svg';
			$panel = new SimpleXmlElement(svg($root));
			$panel->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');
			static::$panel = $panel;
		}

		// find the icon with the correct id
		$svgs = static::$panel->xpath('//svg:symbol[@id="icon-' . $this->name . '"]');
		$svg  = $svgs[0] ?? null;

		// if the icon is not found, return null
		if ($svg === null) {
			return null;
		}

		// if the symbol references another icon, return the SVG of that icon
		if ($use = $svg->use) {
			$name = Str::after($use['href'], '#icon-');
			$icon = new Icon($name, $this->title);
			return $icon->getFromPanel();
		}

		return new SimpleXmlElement('<svg data-type="' . $this->name . '" xmlns="http://www.w3.org/2000/svg" viewBox="' . $svg['viewBox'] . '">' . $svg->innerXml() . '</svg>');
	}

	/**
	 * Adds necessary attributes to the SVG markup
	 * for accessibility
	 */
	protected function normalize(SimpleXmlElement $svg): SimpleXmlElement
	{
		if ($this->title) {
			$id = Str::uuid();
			$svg['role'] = 'img';
			$svg['aria-labelledby'] = $id;
			$svg->prependChild('title', $this->title)->addAttribute('id', $id);
		}

		if (isset($svg->title) === false) {
			$svg['aria-hidden'] = 'true';
		}

		return $svg;
	}

	/**
	 * Returns the SVG markup for the icon
	 */
	public function render(): string|null
	{
		$svg   = $this->getFromLocal();
		$svg ??= $this->getFromPanel();

		if ($svg === null) {
			return null;
		}

		return $this->normalize($svg)->asXML();
	}
}

