<?php

return function ($page) {

  return [
    'headlines' => $page->text()->headlines('h2')
  ];

};
