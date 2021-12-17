<?php

return function ($page) {

  $releases     = Data::read($page->file('releases.json')->root());
  $contributors = $page->contributors()->yaml();
  $recipes      = page('docs/cookbook')->children()->children()->filterBy('published', '>=', '2021-01-01')->filterBy('published', '<=', '2021-12-31')->sortBy('published', 'desc');
  $issues       = page('kosmos')->children()->filterBy('num', '>=', '20210101')->filterBy('num', '<=', '20211231')->sortBy('num', 'desc');
  $plugins      = page('plugins')->children()->children();
  $plugins2021  = Data::read($page->root() . '/plugins-2021.yaml');
  $plugins2021  = $plugins->find($plugins2021)->sortBy('title', 'asc');

  sort($contributors);

  return [
    'contributors' => $contributors,
    'issues'       => $issues,
    'plugins'      => $plugins,
    'plugins2021'  => $plugins2021,
    'releases'     => $releases,
    'recipes'      => $recipes
  ];

};
