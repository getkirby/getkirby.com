<?php

return [
    [
        'pattern' => 'reference/(:all?)',
        'action'  => function ($path = null) {
            go('docs/reference/' . $path);
        }
    ],
    [
        'pattern' => 'blog/kosmos-(:any)',
        'action'  => function ($path = null) {
            go('kosmos/' . $path);
        }
    ],
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
    ],
    [
        'pattern' => 'robots.txt',
        'method'  => 'ALL',
        'action'  => function () {
            $robots  = 'User-agent: *' . PHP_EOL;

            if (option('beta')) {
                $robots .= 'Disallow: /';
            } else {
                $robots .= 'Allow: /';
            }

            return kirby()
                ->response()
                ->type('text')
                ->body($robots);
        }
    ]
];
