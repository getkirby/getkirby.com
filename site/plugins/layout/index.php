<?php

include_once __DIR__ . '/helpers.php';

load([
    'kirby\\layout\\layout'   => __DIR__ . '/src/Layout.php',
    'kirby\\layout\\slots'    => __DIR__ . '/src/Slots.php',
    'kirby\\layout\\template' => __DIR__ . '/src/Template.php',
]);

Kirby::plugin('getkirby/layout', [
    'components' => [
        'template' => function (Kirby $kirby, string $name, string $type = 'html', string $defaultType = 'html') {
            return new Kirby\Layout\Template($name, $type, $defaultType);
        },
    ]
]);
