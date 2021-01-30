<?php


return function($page) {

  $sidebarItemTemplates = ['cookbook', 'reference', 'glossary'];
  
  $items = $page->children()->listed();

  return [
    'mainItems' => $items->filterBy('template', 'not in', $sidebarItemTemplates),
    'sidebarItems' => $items->filterBy('template', 'in', $sidebarItemTemplates),
  ];

};
