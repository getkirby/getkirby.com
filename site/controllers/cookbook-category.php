<?php

return function ($page) {

  $recipes = $page
    ->children()
    ->listed()
    ->sortBy('published', 'desc');

  return [
    'recipes' => $recipes
  ];

};
