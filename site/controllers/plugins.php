<?php

return function($page) {

  $categories = option('plugins.categories');
  $category   = param('category');
  $heading    = 'Featured';

  if ($category && array_key_exists($category, $categories) === false) {
    $category = null;
  }

  if ($category) {
    $plugins = $page
      ->children()
      ->children()
      ->filterBy('recommended', '')
      ->sortBy('title', 'asc');

    $plugins = $plugins->filterBy('category', $category);
    $heading = $categories[$category]['label'] . ' plugins';
  } else {
    $plugins = new Pages();
  }

  return [
    'categories'      => $categories,
    'currentCategory' => $category,
    'heading'         => $heading,
    'plugins'         => $plugins,
  ];

};
