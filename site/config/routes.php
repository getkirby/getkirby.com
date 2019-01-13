<?php

return [
    [
        'pattern' => 'reference/(:all?)',
        'action'  => function ($path = null) {
            go('docs/reference/' . $path);
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
    ]
];
