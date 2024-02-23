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

	$src = match (empty($props['src'])) {
		true    => $file->url(),
		default => $file->thumb($props['src'])->url()
	};

	$srcset = match (empty($props['srcset'])) {
		true    => null,
		default => $file->srcset($props['srcset'])
	};

	if (($props['lazy'] ?? true) === true) {
		$loading = 'lazy';
	}

	$img = '<img ' . attr([
		'alt'     => $props['alt'] ?? '',
		'class'   => $props['class'] ?? null,
		'loading' => $loading ?? null,
		'src'     => $src,
		'srcset'  => $srcset,
		'width'   => $file->width(),
		'height'  => $file->height()
	]) . '>';

	if (empty($props['lightbox']) === false && $props['lightbox'] !== false) {
		return Html::a($file->resize(1800, 1800)->url(), [$img], [
			'class'         => 'block',
			'style'         => '--aspect-ratio: ' . $file->width() . '/' . $file->height(),
			'data-lightbox' => $props['lightbox']
		]);
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
