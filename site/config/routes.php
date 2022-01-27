<?php

return [
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
    [
        'pattern' => 'releases/(:num)\.(:num)/(:all?)',
        'action'  => function ($generation, $major, $path) {
            return page('releases/' . $generation . '-' . $major . '/' . $path);
        }
    ],
    [
        'pattern' => 'buy/checkout/(:any)',
        'action'  => function($volume) {
            try {
                $checkout = new Kirby\Paddle\Checkout();
                go($checkout->url($volume));
            } catch (Throwable $e) {
                die($e->getMessage() . '<br>Please contact us: support@getkirby.com');
            }
        }
    ],
    [
        'pattern' => 'pixels',
        'action'  => function () {
            return new Page([
                'slug'     => 'pixels',
                'template' => 'pixels',
                'content'  => [
                    'title' => 'Pixels'
                ]
            ]);
        }
    ],
];
