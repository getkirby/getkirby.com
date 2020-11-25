<?php

return function ($page) {

  return [
    'root' => $page->parents()->last() ?? $page,
  ];

};
