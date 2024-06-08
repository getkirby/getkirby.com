<?php

use Kirby\Toolkit\Html;
use Kirby\Toolkit\Xml;

function ariaCurrent(
	bool $condition,
	mixed $type = true,
	string $prefix = ' '
): string|null {
	return $condition ? $prefix . attr(['aria-current' => $type]) : null;
}

function icon(string $name): string|false
{
	// prefer custom icon files from assets folder
	if ($svg = svg('assets/icons/' . $name . '.svg')) {
		return $svg;
	}

	// fall back to Panel icons
	static $panel;
	$panel ??= svg('kirby/panel/dist/img/icons.svg');

	if ($panel) {
		// find the icon in the Panel sprite
		if (preg_match('/<symbol[^>]*id="icon-' . $name . '"[^>]*viewBox="(.*?)"[^>]*>(.*?)<\/symbol>/s', $panel, $matches)) {

			//  resolve <use> tags to full inline SVG
			if (preg_match('/<use href="#icon-(.*?)"[^>]*?>/s', $matches[2], $use)) {
				return icon($use[1]);
			}

			// return the icon with the correct viewBox
			return '<svg data-type="' . $name . '" xmlns="http://www.w3.org/2000/svg" viewBox="' . $matches[1] . '">' . $matches[2] . '</svg>';
		}
	}

	return false;
}

function img($file, array $props = [])
{
	if (is_string($file) === true) {
		$file = image($file);
	}

	if (!$file) {
		return;
	}

	if (empty($props['src']) === false) {
		$thumb  = $file->thumb($props['src']);
		$src    = $thumb->url();
		$width  = $thumb->width();
		$height = $thumb->height();
	}

	if (empty($props['srcset']) === false) {
		$srcset = $file->srcset($props['srcset']);
	}

	$sizes = $props['sizes'] ?? null;
	if (($props['lazy'] ?? true) === true) {
		$loading = 'lazy';

		// browser can determine the rendered size for lazy-loaded
		// images if we haven't defined a manual `sizes` attribute
		if ($srcset ?? null) {
			$sizes ??= 'auto';
		}
	}

	$src    ??= $file->url();
	$width  ??= $file->width();
	$height ??= $file->height();

	$img = '<img ' . attr([
		'alt'     => $props['alt'] ?? '',
		'class'   => $props['class'] ?? null,
		'style'   => $props['style'] ?? null,
		'loading' => $loading ?? null,
		'sizes'   => $sizes,
		'src'     => $src,
		'srcset'  => $srcset ?? null,
		'width'   => $width,
		'height'  => $height
	]) . '>';

	if (empty($props['lightbox']) === false && $props['lightbox'] !== false) {
		return Html::a(
			$file->resize(1800, 1800)->url(),
			[$img],
			[
				'class'         => 'block',
				'style'         => '--aspect-ratio: ' . $width . '/' . $height,
				'data-lightbox' => $props['lightbox']
			]
		);
	}

	return $img;
}

function json(array $data, bool $pretty = true): string|false
{
	if ($pretty === true) {
		return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	return json_encode($data);
}

function version(string $version, string $format = '%s'): string
{
	return Html::a(
		option('github.url') . '/kirby/releases/tag/' . $version,
		sprintf($format, $version)
	);
}

if (function_exists('xml') === false) {
	function xml($value)
	{
		return Xml::encode($value);
	}
}
