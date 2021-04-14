<?php

$cases = [];

foreach ($page->children() as $child) {
  $cases[] = [
    'id'    => $child->slug(),
    'title' => $child->title()->value(),
    'url'   => $child->link()->value(),
  ];
}

echo json($cases);
