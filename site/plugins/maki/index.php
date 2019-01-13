<?php

include __DIR__ . '/vendor/autoload.php';

Kirby::plugin('kirby/maki', [
    'components'   => include __DIR__ . '/components.php',
    'hooks'        => include __DIR__ . '/hooks.php',
    'tags'         => include __DIR__ . '/tags.php',
]);
