<?php

return function ($page) {
  $categories = option('plugins.categories');

  $related = page('plugins')
    ->grandChildren()
    ->filterBy('category', $page->category()->value())
    ->not($page);

  if ($page->subcategory()->isNotEmpty()) {
    $related = $related->filterBy('subcategory', $page->subcategory()->value());
  }

  return [
    'categories'      => $categories,
    'currentCategory' => $page->category(),
    'download'        => $page->download(),
    'author'          => $page->parent(),
    'authorPlugins'   => $page->siblings(false),
    'relatedPlugins'  => $related
  ];
};
