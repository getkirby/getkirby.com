<?php

include '../kirby/vendor/autoload.php';

$options = [
    'roots' => [
        'index'   => __DIR__,
        'content' => __DIR__ . '/../content',
        'site'    => __DIR__ . '/../site',
    ]
];

if(in_array(Url::host(), ['getkirby.com', 'staging.getkirby.com'])) {
    $options['urls'] = [
        'assets' => 'dist'
    ];
}

$kirby = new Kirby($options);

echo $kirby->render();