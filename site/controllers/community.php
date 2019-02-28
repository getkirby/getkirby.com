<?php

return function ($site, $page) {
  return [
    'mates' => $page->find('team')->children()->listed(),
    'pluginsPage' => $page->find('plugins'),
    'plugins' => $page->find('plugins')->children()->listed(),
  ];
};
