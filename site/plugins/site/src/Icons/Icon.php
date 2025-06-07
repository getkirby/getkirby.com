<?php

namespace Kirby\Icons;

use Kirby\Cms\App;
use Kirby\Toolkit\Str;

/**
 * Renders SVG icons from the Kirby Panel SVG sprite
 * or local directory, taking a11yn into account
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
		// Load the Panel SVG sprite
		if (isset(static::$panel) === false) {
			$root  = App::instance()->root();
			$root .= '/kirby/panel/dist/img/icons.svg';
			$panel = new SimpleXmlElement(svg($root));
			$panel->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');
			static::$panel = $panel;
		}

		// Find the icon with the correct id
		$id   = 'icon-' . $this->name;
		$svgs = static::$panel->xpath('//svg:symbol[@id="' . $id . '"]');
		$svg  = $svgs[0] ?? null;

		// If the icon is not found, return null
		if ($svg === null) {
			return null;
		}

		// If the symbol references another icon, return the SVG of that icon
		if ($use = $svg->use) {
			$name = Str::after($use['href'], '#icon-');
			$icon = new Icon($name, $this->title);
			return $icon->getFromPanel();
		}

		return new SimpleXmlElement('<svg data-type="' . $this->name . '" xmlns="http://www.w3.org/2000/svg" viewBox="' . $svg['viewBox'] . '">' . $svg->innerXml() . '</svg>');
	}

	/**
	 * Adds attributes to the SVG markup for a11yn
	 */
	protected function normalize(SimpleXmlElement $svg): SimpleXmlElement
	{
		// If a title is provided, add it to the SVG
		if ($this->title) {
			// If the SVG already has a title, remove it
			if ($svg->title) {
				unset($svg->title);
			}

			// Add the title to the SVG
			$id = Str::uuid();
			$svg['role'] = 'img';
			$svg['aria-labelledby'] = $id;
			$svg->prependChild('title', $this->title)->addAttribute('id', $id);
		}

		// If the SVG does not have a title, mark as decorative
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
		// Get the SVG element
		$svg   = $this->getFromLocal();
		$svg ??= $this->getFromPanel();

		if ($svg === null) {
			return null;
		}

		// Perform normalization
		$svg = $this->normalize($svg);
		$svg = $svg->asXML();
		$svg = explode("\n", $svg);
		$svg = array_slice($svg, 1);
		return implode('', $svg);
	}
}

