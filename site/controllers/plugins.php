<?php

return function($page) {

  $categories = option('plugins.categories');
  $category   = get('category');
  $developer  = get('developer');

  if ($category && array_key_exists($category, $categories) === false) {
    $category = null;
  }

  if ($developer && !$page->find($developer)) {
    $developer = null;
  }

  $plugins = $page->children()->children();

  if ($developer) {
    $plugins = $page->find($developer)->children();
  }

  if ($category) {
    $plugins = $plugins->filterBy('category', $category);
  }

  // don't use plugins with a recommended field
  $plugins = $plugins->filterBy('recommended', '');

  return [
    'plugins'    => $plugins->sortBy('title', 'asc'),
    'categories' => $categories,
    'category'   => $category,
    'developer'  => $developer
  ];

};
