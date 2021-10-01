<?php

return function ($kirby, $page) {
  $categories = option('plugins.categories');

  return [
    'categories'      => $categories,
    'author'          => $page,
    'authorPlugins'   => $page->children()
  ];
};
