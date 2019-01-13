<?php

return function($page) {

  return [
    'guide' => $page->parents()->findBy('template', 'guide'),
  ];

};
