<?php

return function ($site, $page) {
  return [
    'mates'       => $page->find('team')->children()->listed(),
    'forum'       => $page->find('forum'),
    'themes'      => $page->find('themes'),
    'pluginsPage' => $page->find('plugins'),
    'plugins'     => page('plugins')->children()->children()->filterBy('featured', 'true')->shuffle()->limit(9),
  ];
};
