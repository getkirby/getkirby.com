<?php

return function ($page) {
  return [
    'items' => $page->children()->sortBy('title', 'asc'),
  ];
};
