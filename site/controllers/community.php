<?php

return function ($site, $page) {
  return [
    'mates' => $page->find('team')->children()->listed(),
  ];
};
