<?php

return function ($page) {

  if ($page->text()->isEmpty() && $page->hasChildren()) {
    go($page->children()->first()->url());
  }

  return [
    'guide' => $page,
  ];

};
