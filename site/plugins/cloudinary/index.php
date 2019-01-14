<?php

function cloudinary($url, $params = []) {

    if (is_object($url) === true) {
        $url = $url->url();
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
            if (option('cloudinary', false) === false) {
                return $file->mediaUrl();
            } else {
                return cloudinary($file->mediaUrl());
            }
        }
    ]
]);
