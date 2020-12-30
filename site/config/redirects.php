<?php

return [
    // Simple
    'docs/guide/installation'         => 'docs/guide/quickstart',
    'reference/(:all?)'               => 'docs/reference/$1',
    'docs/cheatsheet/(:all?)'         => 'docs/reference/$1',
    'docs/toolkit/(:all?)'            => 'docs/reference/$1',
    'docs/cookbook/migration/sites'   => 'docs/cookbook/setup/migrate-site',
    'docs/cookbook/migration/files'   => 'docs/cookbook/setup/migrate-files',
    'docs/cookbook/migration/users'   => 'docs/cookbook/setup/migrate-users',
    'docs/cookbook/migration/plugins' => 'docs/cookbook/setup/migrate-plugins',
    'v3'                              => 'releases/3.0',
    'v35'                             => 'releases/3.5',
    'blog/kosmos-(:any)'              => 'kosmos/$1',
    'made-with-kirby-and-love'        => 'love',

    // With logic
    'docs/reference/(:any)/(:all?)' => function ($group, $path = null) {
        if ($page = page('docs/reference')->grandChildren()->listed()->findBy('uid', $group)) {
            return $page->id() . '/'. $path;
        }
        
        return 'error';
    },
    'docs/cookbook/(:any)/(:all)'     => function ($category, $uid) {
        if ($page = page('docs/cookbook')->grandChildren()->listed()->findBy('uid', $uid)) {
            return $page->url();
        }
        
        return 'error';
    }
];