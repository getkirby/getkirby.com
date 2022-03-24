<?php snippet('templates/plugins/section', [
  'icon'    => 'widget',
  'id'      => 'extensions',
  'title'   => 'Panel Extensions',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'view')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'blocks',
  'icon'    => 'widget',
  'title'   => 'Blocks',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'block')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'sections',
  'icon'    => 'widget',
  'title'   => 'Sections',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'section')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'enhancements',
  'icon'    => 'widget',
  'title'   => 'Enhancements',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
