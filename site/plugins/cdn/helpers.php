<?php

use Kirby\Cms\App;
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
            $params['fit']      = true;
            $params['height'] ??= $params['width'];
            $params['crop']     = match ($params['crop']) {
                'top'   =>  'fp,0,0',
                default => 'smart'
            };

        } else {
            $params['v']       = $file->mediaHash();
            $params['enlarge'] = 0;
            $params['fit']     = match (isset($params['width']) && isset($params['height'])) {
                true => 'inside',
                default => true
            };
        }

        $query = '?' . http_build_query($params);
    }

    if (is_object($file) === true) {
        $file = $file->mediaUrl();
    }

    $path = Url::path($file);
    return App::instance()->option('cdn.domain') . '/' . $path . $query;
}
