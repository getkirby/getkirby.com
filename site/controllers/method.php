<?php

return function ($page) {
  return [
    'inheritedFrom' => $page->inheritedFrom(),
  ];
};
