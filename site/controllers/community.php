<?php

return function ($site, $page) {
  return [
    'mates'       => $page->find('team')->children()->listed(),
    'forum'       => $page->find('forum'),
    'themes'      => $page->find('themes'),
    'pluginsPage' => $page->find('plugins'),
    'plugins'     => $page->find('plugins')->children()->listed(),
  ];
};
