<?php

return function($page) {

  $categories = $page->children()->listed();
  $recipes    = $categories->children()->listed();

  if ($category = $categories->find(get('category'))) {
    $recipes = $category->children()->listed();
  }

  return [
    'recipes'    => $recipes->sortBy('published', 'desc', 'root', 'asc'),
    'categories' => $categories,
    'category'   => $category
  ];

};
