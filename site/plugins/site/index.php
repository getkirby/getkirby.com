<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helpers.php';

Kirby::plugin('kirby/site', [
    'fieldMethods' => include __DIR__ . '/fieldMethods.php',
    'pageModels'   => include __DIR__ . '/pageModels.php',
]);
