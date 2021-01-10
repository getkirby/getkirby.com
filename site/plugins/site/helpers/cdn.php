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
function keycdn($file, array $params = []): string
{
    $query = null;

    if (empty($params) === false) {
        if (empty($params['crop']) === false && $params['crop'] !== false) {
            // use the width as height if the height is not set
            $params['height'] = $params['height'] ?? $params['width'];
        }

        $query = '?' . http_build_query($params);
    }

    if (is_object($file) === true) {
        $file = $file->mediaUrl();
    }

    $path = Url::path($file);
    return option('keycdn.domain') . '/' . $path . $query;
}