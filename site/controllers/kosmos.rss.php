<?php

return function ($page) {
  return [
    'issues' => $page->children()->flip(),
  ];
};
