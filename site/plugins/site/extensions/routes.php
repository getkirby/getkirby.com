<?php

use Kirby\Meta\SiteMeta;

return [
    /* Meta */
    [
        'pattern' => 'robots.txt',
        'method' => 'ALL',
        'action' => function () {
            return SiteMeta::robots();
        },
    ],
    [
        'pattern' => 'sitemap.xml',
        'action' => function () {
            return SiteMeta::sitemap();
        }
    ],
    [
        'pattern' => 'open-search.xml',
        'action' => function () {
            return SiteMeta::search();
        },
    ],

];
