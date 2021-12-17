<?php

return function ($page) {

  $releases     = Data::read($page->file('releases.json')->root());
  $contributors = $page->contributors()->yaml();
  $recipes      = page('docs/cookbook')->children()->children()->filterBy('published', '>=', '2021-01-01')->sortBy('published', 'desc');
  $issues       = page('kosmos')->children()->filterBy('num', '>=', '20210101')->sortBy('num', 'desc');

  sort($contributors);

  return [
    'contributors' => $contributors,
    'issues'       => $issues,
    'releases'     => $releases,
    'recipes'      => $recipes
  ];

};
