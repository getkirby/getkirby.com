<?php

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

    $params  = array_merge(['q' => 'auto'], $params);
    $options = [];

    foreach ($params as $key => $value) {
        $options[] = $key . '_' . $value;
    }

    $options = implode(',', $options);

    return 'https://res.cloudinary.com/getkirby/image/fetch/f_auto,' . $options . '/' . option('cloudinary.domain') . $url;

}

Kirby::plugin('getkirby/cloudinary', [
    'components' => [
        'file::url' => function ($kirby, $file) {
            return cloudinary($file->mediaUrl());
        }
    ]
]);
