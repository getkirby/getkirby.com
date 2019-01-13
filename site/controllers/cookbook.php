<?php

return function ($page) {

  $recipes = $page->children()->children()->listed()->sortBy('title', 'asc');

  return [
    'categories' => $recipes->pluck('category', ',', true),
    'recipes'    => $recipes
  ];

};
