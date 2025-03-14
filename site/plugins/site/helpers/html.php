<?php

use Kirby\Cms\File;
use Kirby\Icons\Icon;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\Xml;

function ariaCurrent(
	bool $condition,
	mixed $type = true,
	string $prefix = ' '
): string|null {
	return $condition ? $prefix . attr(['aria-current' => $type]) : null;
}

function icon(
	string $name,
	string|null $title = null
): string|null {
	$icon = new Icon($name, $title);
	return $icon->render();
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
		'alt'           => $props['alt'] ?? '',
		'class'         => $props['class'] ?? null,
		'style'         => $props['style'] ?? null,
		'loading'       => $loading ?? null,
		'fetchpriority' => $props['fetchpriority'] ?? null,
		'sizes'         => $sizes,
		'src'           => $src,
		'srcset'        => $srcset ?? null,
		'width'         => $width,
		'height'        => $height
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

/**
 * Creates a privacy-friendly video embed via iframe for YouTube
 */
function video(
	string $url,
	File $poster,
	array $options = [],
	array $attr = [],
): string|null {
	if (Str::contains($url, 'vimeo', true) === true) {
		throw new Exception('Vimeo support is not implemented');
	}

	// delegate local video support to the core implementation
	if (Str::contains($url, 'youtu', true) === false) {
		return Html::video($url, $options, $attr);
	}

	// normalize video URL for the fallback link
	$url = str_replace('youtu.be/', 'www.youtube.com/watch?v=', $url);
	$url = str_replace('www.youtube-nocookie.com', 'www.youtube.com', $url);

	// but always use privacy mode for embedding
	$privacyUrl = str_replace('www.youtube.com', 'www.youtube-nocookie.com', $url);

	// get the iframe string from the core
	$iframe = Html::youtube($privacyUrl, [
		...$options['youtube'] ?? [],
		'autoplay' => 1,
		'showinfo' => 0,
		'rel'      => 0,
	], [
		...$attr,
		'referrerpolicy' => 'no-referrer'
	]);

	return snippet('video', compact('attr', 'iframe', 'url', 'poster'), true);
}

if (function_exists('xml') === false) {
	function xml($value)
	{
		return Xml::encode($value);
	}
}
