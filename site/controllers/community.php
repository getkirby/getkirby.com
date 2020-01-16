<?php

return function ($page) {
  return [
    'contributors' => $page->find('contributors')->children()->listed()->shuffle(),
    'konf' => page('konf'),
  ];
};
