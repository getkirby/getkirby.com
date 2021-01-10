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

    /* Webhooks */
    [
        'pattern' => 'hooks/clean',
        'method'  => 'GET|POST',
        'action'  => function () {
            $key = trim(F::read(__DIR__ . '/keys/hooks.txt'));

            if (empty($key) === false && get('key') === $key) {
                kirby()->cache('pages')->flush();
            }

            go();
        }
    ]
];
