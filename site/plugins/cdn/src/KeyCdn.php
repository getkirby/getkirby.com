<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Http\Url;
use Kirby\Image\Darkroom;
use Kirby\Image\Focus;

class KeyCdn
{
	/**
	 * Generates a URL with KeyCDN image processing parameters
	 * (https://www.keycdn.com/support/image-processing)
	 * based on a file URL or object and Kirby thumb params
	 */
	public static function url(string|File $file, array $params = []): string
	{
		$kirby = App::instance();

		$root = $file;
		if (is_object($file) === true) {
			$root = $file->root();
			$file = $file->mediaUrl();
		}

		$path = Url::path($file);

		$darkroom = Darkroom::factory(
			'im',
			$kirby->option('thumbs', [])
		);
		$params = $darkroom->preprocess($root, $params);

		$query = '';
		if (empty($params) === false) {
			$query = '?' . http_build_query([
				...static::resizeOrCrop($params),
				...static::grayscale($params),
				...static::progressive($params),
				...static::blur($params),
				...static::sharpen($params),
			]);
		}

		return $kirby->option('cdn.domain') . '/' . $path . $query;
	}

	protected static function blur(array $params): array
	{
		if ($params['blur'] !== false) {
			$blur = max(0.3, min(100, $params['blur']));
			return compact('blur');
		}

		return [];
	}

	protected static function grayscale(array $params): array
	{
		if ($params['grayscale'] === true) {
			return ['grayscale' => 1];
		}

		return [];
	}

	protected static function progressive(array $params): array
	{
		if ($params['interlace'] === true) {
			return ['progressive' => 1];
		}

		return [];
	}

	protected static function resizeOrCrop(array $params): array
	{
		$query = [
			'width'  => $params['width'],
			'height' => $params['height'],
		];

		// simple resize
		if ($params['crop'] === false) {
			$query['enlarge'] = 0;

			return $query;
		}

		// crop based on focus point
		if (Focus::isFocalPoint($params['crop']) === true) {
			$focus = Focus::parse($params['crop']);
			$query['crop'] = 'fp,' . $focus[0] . ',' . $focus[1];

			return $query;
		}

		// translate the gravity option into something KeyCDN understands
		$query['crop'] = match ($params['crop'] ?? null) {
			'top left'     => 'fp,0,0',
			'top'          => 'fp,0.5,0',
			'top right'    => 'fp,1.0,0',
			'left'         => 'fp,0,0.5',
			'center'       => 'fp,0.5,0.5',
			'right'        => 'fp,1,0.5',
			'bottom left'  => 'fp,0,1.0',
			'bottom'       => 'fp,0.5,1.0',
			'bottom right' => 'fp,1.0,1.0',
			default        => 'smart'
		};

		return $query;
	}

	protected static function sharpen(array $params): array
	{
		if (is_int($params['sharpen']) === true) {
			$sharpen = max(0, min(100, $params['sharpen']));
			return compact('sharpen');
		}

		return [];
	}
}
