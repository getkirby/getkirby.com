<?php

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Http\Url;

/**
 * Helper function for image modifications via KeyCDN.
 * Takes a path string to a file or a `\Kirby\Cms\File` object
 * as well as an array of KeyCDN image optimization parameters
 */
function cdn(string|File $file, array $params = []): string
{
	$query = null;

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

		$params['v'] = $file->mediaHash() . '-1';

		$query = '?' . http_build_query($params);
	}

	if (is_object($file) === true) {
		$file = $file->mediaUrl();
	}

	$path = Url::path($file);
	return App::instance()->option('cdn.domain') . '/' . $path . $query;
}
