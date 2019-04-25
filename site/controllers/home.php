<?php

return function ($kirby, $page) {

  return [
    'chameleon'  => $page->image('chameleon.jpg'),
    'components' => $page->image('components.jpg'),
    'hero'       => $page->image('hero.jpg'),
    'matomo'     => $page->image('matomo.jpg'),
    'panel'      => $page->images()->filterBy('name', '*=', 'interface'),
  ];

};
