<?php

return function($page) {

  $categories = $page->children()->listed();
  $recipes    = $categories->children()->listed();

  if ($category = get('category')) {
    $recipes = $page->recipes($category);
  }

  return [
    'recipes'    => $recipes->sortBy('published', 'desc', 'root', 'asc'),
    'categories' => $categories,
    'category'   => $categories->find($category)
  ];

};
