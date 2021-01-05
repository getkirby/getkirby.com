<?php

use Kirby\Cms\App;
use Kirby\Cms\FileModifications;
use Kirby\Cms\FileVersion;
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


Kirby::plugin('getkirby/keycdn', [
    'components' => [
        'url' => function (App $kirby, $path, $options): string {

            static $original;

            if ($original === null) {
                $original = $kirby->nativeComponent('url');
            }

            if (preg_match('!assets!', $path)) {
                $path = Cachebuster::path($path);

                if (option('keycdn', false) !== false) {
                    return option('keycdn.domain') . '/' . $path;
                }
            }
            
            return $original($kirby, $path, $options);
        },
        'file::version' => function (App $kirby, $file, $options) {

            static $original;

            if (option('keycdn', false) !== false) {
                $url = keycdn($file, $options);

                return new FileVersion([
                    'modifications' => $options,
                    'original'      => $file,
                    'root'          => $file->root(),
                    'url'           => $url,
                ]);
            }

            if ($original === null) {
                $original = $kirby->nativeComponent('file::version');
            }

            return $original($kirby, $file, $options);
        },
        'file::url' => function (App $kirby, $file): string {

            static $original;

            if ($file->type() === 'image') {
                return keycdn($file);
            }

            if ($original === null) {
                $original = $kirby->nativeComponent('file::url');
            }

            return $original($kirby, $file);
        }
    ]
]);
