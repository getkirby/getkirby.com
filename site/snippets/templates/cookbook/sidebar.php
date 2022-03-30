<?php
$items = [];

foreach (collection('cookbook/categories') as $category) {
  $items[] = [
    'title' => $category->title(),
    'link'  => $category->url(),
    'icon'  => $category->icon(),
    'open'  => ariaCurrent($category->isOpen())
  ];
}

snippet('sidebar/sidebar' , [
  'title' => 'Cookbook',
  'items' => array_merge([
    [
      'title' => 'All recipes',
      'icon'  => 'list',
      'link'  => '/docs/cookbook',
      'open'  => ariaCurrent($page->slug() === 'cookbook')
    ],
		[
      'title' => 'New',
      'icon'  => 'flash',
      'link'  => '/docs/cookbook/new',
      'open'  => ariaCurrent($page->slug() === 'new')
    ],
    [
      'title' => 'Search',
      'icon'  => 'search',
      'id'    => 'cookbook'
    ],
    [
      'title' => '-'
    ]
  ],
  $items
  )
]) ?>
