<?php

snippet('templates/plugins/section', [
  'icon'    => 'layout',
  'id'      => 'git',
  'title'   => 'Panel extensions',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'view')->flip()->pluck('id')
])

?>

<?php snippet('templates/plugins/section', [
  'icon'    => 'layout',
  'id'      => 'git',
  'title'   => 'Hooks',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]);
