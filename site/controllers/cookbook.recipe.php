<?php

return function ($page) {

  $categories = array_map(function ($category) use ($page) {
    return [
      'slug'  => $category->slug(),
      'title' => $category->title(),
      'items' => $category->parent()->recipes($category->slug())->not($page)->shuffle()->limit(5)
    ];
  }, $page->categories());

  return [
    'headlines'  => $page->text()->headlines('h2'),
    'categories' => $categories
  ];

};
