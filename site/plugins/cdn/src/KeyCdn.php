<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Http\Url;
use Kirby\Image\Darkroom;

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
			]);
		}

		return $kirby->option('cdn.domain') . '/' . $path . $query;
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

		$query['crop'] = match ($params['crop']) {
			'top'   =>  'fp,0,0',
			default => 'smart'
		};

		return $query;
	}
}
