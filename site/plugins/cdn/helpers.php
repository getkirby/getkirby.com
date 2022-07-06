<?php

use Kirby\Http\Url;

/**
 * Helper function for image modifications via KeyCDN.
 * Takes a path string to a file or a `\Kirby\Cms\File` object
 * as well as an array of KeyCDN image optimization parameters
 *
 * @param string|\Kirby\Cms\File $file
 * @param array $params
 * @return string
 */
function cdn($file, array $params = []): string
{
	$query = null;

	if (empty($params) === false) {
		// Use the width as height if the height is not set
		if (empty($params['crop']) === false && $params['crop'] !== false) {
			$params['height'] = $params['height'] ?? $params['width'];

			if ($params['crop'] === 'top') {
				$params['crop'] = 'fp,0,0';
			} else {
				$params['crop'] = 'smart';
			}

			$params['fit'] = true;
		} else {
			if (isset($params['width']) && isset($params['height'])) {
				$params['fit'] = 'inside';
			} else {
				$params['fit'] = true;
			}
			$params['enlarge'] = 0;
		}

		$params['v'] = $file->mediaHash();

		$query = '?' . http_build_query($params);
	}

	if (is_object($file) === true) {
		$file = $file->mediaUrl();
	}

	$path = Url::path($file);
	return option('cdn.domain') . '/' . $path . $query;
}
