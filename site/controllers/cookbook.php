<?php

return function($page) {

  $categories = $page->children()->listed();
  $recipes    = $categories->children()->listed();

  if ($category = get('category')) {
    $recipes = $page->recipes($category);
  }

  if (get('new')) {
    $recipes = $page->grandChildren()->filterBy('isNew', true);
  }

  return [
    'recipes'    => $recipes->sortBy('title', 'asc'),
    'categories' => $categories,
    'category'   => $categories->find($category)
  ];

};
