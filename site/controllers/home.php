<?php

return function ($kirby, $page) {

  if ($kirby->option('beta') && get('half-assed') !== 'protection') {
    go('docs');
  }

  return [
    'chameleon'  => $page->image('chameleon.jpg'),
    'components' => $page->image('components.jpg'),
    'hero'       => $page->image('hero.jpg'),
    'matomo'     => $page->image('matomo.jpg'),
  ];

};
