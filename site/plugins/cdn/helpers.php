<?php

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Http\Url;

/**
 * Generates a URL with KeyCDN image processing parameters
 * (https://www.keycdn.com/support/image-processing)
 * based on a file URL or object and Kirby thumb params
 */
function cdn(string|File $file, array $params = []): string
{
	$query = '';

	if (is_object($file) === true) {
		$file = $file->mediaUrl();
	}

	$path = Url::path($file);

	if (empty($params) === false) {
		// Use the width as height if the height is not set
		if (empty($params['crop']) === false && $params['crop'] !== false) {
			$params['fit']      = true;
			$params['height'] ??= $params['width'];
			$params['crop']     = match ($params['crop']) {
				'top'   =>  'fp,0,0',
				default => 'smart'
			};
		} else {
			$params['enlarge'] = 0;
			$params['fit']     = match (isset($params['width'], $params['height'])) {
				true    => 'inside',
				default => true
			};
		}

		$query = '?' . http_build_query($params);
	}

	return App::instance()->option('cdn.domain') . '/' . $path . $query;
}
