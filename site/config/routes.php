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

    /**
     * Legacy redirects
     */
    [
        'pattern' => 'docs/guide/installation',
        'action'  => function () {
            go('docs/guide/quickstart');
        }
    ],
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
        'pattern' => 'docs/cookbook/(:any)/(:all)',
        'action'  => function ($category, $uid) {
            $path = $category . '/' . $uid;

            if ($page = page('docs/cookbook/' . $path)) {
                return $page;
            }

            $aliases = [
                'migration/sites' => 'setup/migrate-site',
                'migration/files' => 'setup/migrate-files',
                'migration/users' => 'setup/migrate-users',
                'migration/plugins' => 'setup/migrate-plugins',
            ];

            if ($page = page('docs/cookbook/' . ($aliases[$path] ?? $path))) {
                go($page->url());
            }

            if ($page = page('docs/cookbook')->grandChildren()->listed()->findBy('uid', $uid)) {
                go($page->url());
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
    [
        'pattern' => 'releases',
        'action'  => function () {
            return false;
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
        'pattern' => 'v3',
        'action'  => function () {
            return go('releases/3.0');
        }
    ],
    [
        'pattern' => 'v35',
        'action'  => function () {
            return go('releases/3.5');
        }
    ],
];
