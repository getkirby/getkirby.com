<?php

return [

    'url' => '/',
    'markdown' => [
        'extra' => true,
    ],
    'price' => [
        'eur' => 99,
        'usd' => 115
    ],
    'sale' => [
        'text' => 'Save €10 per license<br> with our Kirby 3 launch price!<br><small class="description" style="font-size: .75rem; font-weight: 400">only until January 29th</small>',
        'eur' => 89,
        'usd' => 105
    ],

    'api'     => false,
    'panel'   => false,
    'debug'   => true,
    'algolia' => require __DIR__ . '/algolia.php',
    'routes'  => require __DIR__ . '/routes.php',
    'github'  => 'https://github.com/getkirby',

];
