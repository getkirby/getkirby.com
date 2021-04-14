<?php

return function ($kirby, $page) {
  $categories = option('plugins.categories');

  return [
    'categories'      => $categories,
    'currentCategory' => $page->category(),
    'download'        => $page->download(),
    'author'          => $page->parent(),
    'authorPlugins'   => $page->siblings(false),
    'relatedPlugins'  => page('plugins')->grandChildren()->filterBy('category', $page->category()->value())->not($page)
  ];
};
