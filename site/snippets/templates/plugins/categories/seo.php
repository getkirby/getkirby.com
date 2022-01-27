<?php snippet('templates/plugins/section', [
  'id'      => 'panel',
  'icon'    => 'seo',
  'title'   => 'Panel',
  'layout'  => 'hero',
  'plugins' => [
    'plugins/diesdasdigital/metaknight'
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'analytics',
  'title'   => 'Templating',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'templating')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'analytics',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
