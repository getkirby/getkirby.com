<?php snippet('templates/plugins/section', [
  'id'      => 'doctor',
  'icon'    => 'lock',
  'title'   => 'Panel',
  'layout'  => 'hero',
  'plugins' => ['plugins/bnomei/doctor']
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'authentication',
  'icon'    => 'lock',
  'title'   => 'Authentication',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'authentication')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'lock',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
