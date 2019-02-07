<?php

return [

    /**
     * New routes
     */
    [
        'pattern' => 'reference/(:all?)',
        'action'  => function ($path = null) {
            go('docs/reference/' . $path);
        }
    ],
    [
        'pattern' => 'made-with-kirby-and-love',
        'action'  => function () {
            go('love');
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
    ],

    /**
     * Legacy redirects
     */
    [
        'pattern' => 'docs/reference/(:any)/(:all?)',
        'action'  => function ($group, $path = null) {
            if ($page = page('docs/reference/' . $group . '/' . $path)) {
                return $page;
            }

            if ($page = page('docs/reference')->grandChildren()->listed()->findBy('uid', $group)) {
                go($page->id() . '/'. $path);
            }

            go('error');
        }
    ],
    [
        'pattern' => [
            'docs/cheatsheet/(:all?)',
            'docs/toolkit/(:all?)'
        ],
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
];
