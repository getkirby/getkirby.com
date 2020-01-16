<?php

return function ($kirby, $page) {

  return [
    'download'       => $page->download(),
    'author'         => $page->parent(),
    'authorPlugins'  => $page->siblings(false),
    'relatedPlugins' => page('plugins')->grandChildren()->filterBy('category', $page->category()->value())->not($page)
  ];

};
