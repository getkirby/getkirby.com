<?php
$items = [];

foreach ($categories as $id => $category) {
  $item = [
    'title' => $category['label'],
    'link'  => '/plugins/category:' . $id,
    'icon'  => $category['icon'],
    'open'  => $id === $currentCategory
  ];

  // $subitems = $page->grandChildren()->filterBy('category', $id)->filterBy('subcategory', '!=', '')->pluck('subcategory', null, true);

  // if (count($subitems) > 0) {
  //   $item['children'] = array_map(function ($subitem) use ($id) {
  //     return [
  //       'title' => $subitem,
  //       'link'  => '/plugins/category:' . $id . '#' . $subitem
  //     ];
  //   }, $subitems);
  // }

  $items[] = $item;
}

snippet('sidebar/sidebar' , [
  'title' => 'Plugins',
  'items' => array_merge([
    [
      'title' => 'Featured',
      'icon'  => 'star',
      'link'  => '/plugins',
      'open'  => ariaCurrent(!$currentCategory)
    ],
    [
      'title' => 'Search',
      'icon'  => 'search',
      'id'    => 'plugin'
    ],
    [
      'title' => '-'
    ]
  ],
  $items
  )
]) ?>

