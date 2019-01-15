<?php

use Kirby\Cms\FileVersion;

function cloudinary($url, $params = [])
{
    if (is_object($url) === true) {
        $url = $url->url();
    }

    // always convert urls to absolute urls
    $url = url($url);

    // return the plain url if cloudinary is deactivated
    if (option('cloudinary', false) === false) {
        return $url;
    }

    $defaults = [
        'q' => 'auto',
        'f' => 'auto'
    ];

    $params  = array_merge($defaults, $params);
    $options = [];

    $map = [
        'width'   => 'w',
        'height'  => 'h',
    ];

    foreach ($params as $key => $value) {
        if (isset($map[$key]) && !empty($value)) {
            $options[] = $map[$key] . '_' . $value;
        }
    }

    $options = implode(',', $options);

    return 'https://res.cloudinary.com/getkirby/image/fetch/' . $options . '/' . option('cloudinary.domain') . $url;

}

Kirby::plugin('getkirby/cloudinary', [
    'components' => [
        'file::version' => function ($kirby, $file, $options = []) {
            $url = cloudinary($file->mediaUrl(), $options);

            return new FileVersion([
                'modifications' => $options,
                'original'      => $file,
                'root'          => $file->root(),
                'url'           => $url,
            ]);
        },
        'file::url' => function ($kirby, $file) {
            return cloudinary($file->mediaUrl());
        }
    ]
]);
