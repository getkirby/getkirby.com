<?php

return [
    [
        'pattern' => 'authors/(:all?)',
        'action'  => function () {
            return false;
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
        'pattern' => 'releases/(:num)\-(:num)',
        'action'  => function ($generation, $major) {
            return go('releases/' . $generation . '.' . $major);
        }
    ],
    [
        'pattern' => 'releases/(:num)\.(:num)',
        'action'  => function ($generation, $major) {
            return page('releases/' . $generation . '-' . $major);
        }
    ],
];
