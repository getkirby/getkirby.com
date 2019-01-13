<?php

include '../kirby/bootstrap.php';

$kirby = new Kirby([
    'roots' => [
        'index'   => __DIR__,
        'content' => __DIR__ . '/../content',
        'site'    => __DIR__ . '/../site',
    ],
]);

echo $kirby->render();
