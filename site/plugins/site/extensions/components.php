<?php

use Kirby\Cachebuster\Cachebuster;
use Kirby\Cms\App;
use Kirby\Cms\FileModifications;
use Kirby\Cms\FileVersion;

return [
    'file::url' => function (App $kirby, $file): string {

        static $original;

        if ($file->type() === 'image') {
            return keycdn($file);
        }

        if ($original === null) {
            $original = $kirby->nativeComponent('file::url');
        }

        return $original($kirby, $file);
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
    'url' => function (App $kirby, $path, $options): string {

        static $original;

        if (preg_match('!assets!', $path)) {
            $path = Cachebuster::path($path);

            if (option('cdn', false) !== false) {
                return option('cdn.domain') . '/' . $path;
            }
        }

        if ($original === null) {
            $original = $kirby->nativeComponent('url');
        }
        
        return $original($kirby, $path, $options);
    },
];
