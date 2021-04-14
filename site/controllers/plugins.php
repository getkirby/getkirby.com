<?php

return function($page) {

  $categories = option('plugins.categories');
  $category   = param('category');
  $heading    = 'All plugins';

  if ($category && array_key_exists($category, $categories) === false) {
    $category = null;
  }

  $plugins = $page
    ->children()
    ->children()
    ->filterBy('recommended', '')
    ->sortBy('title', 'asc');


  if ($category) {
    $plugins = $plugins->filterBy('category', $category);
    $heading = $categories[$category]['label'] . ' plugins';
  }

  return [
    'categories'      => $categories,
    'currentCategory' => $category,
    'heading'         => $heading,
    'plugins'         => $plugins,
  ];

};
