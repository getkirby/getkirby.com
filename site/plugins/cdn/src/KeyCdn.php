<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Http\Url;

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

		if (is_object($file) === true) {
			$file = $file->mediaUrl();
		}

		$path = Url::path($file);

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
		$query = [];

		// Use the width as height if the height is not set
		if (empty($params['crop']) === false && $params['crop'] !== false) {
			$query['width']  = $params['width'];
			$query['height'] = $params['height'] ?? $params['width'];
			$query['crop']   = match ($params['crop']) {
				'top'   =>  'fp,0,0',
				default => 'smart'
			};
		} else {
			$query['width']   = $params['width'];
			$query['enlarge'] = 0;
			if (isset($params['width'], $params['height']) === true) {
				$query['height'] = $params['height'];
				$query['fit']    = 'inside';
			}
		}

		return $query;
	}
}
