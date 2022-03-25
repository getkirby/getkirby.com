<?php snippet('templates/plugins/section', [
  'id'      => 'paper',
  'icon'    => 'wand',
  'title'   => 'Debugging',
  'layout'  => 'hero',
  'columns' => 1,
  'plugins' => $plugins->filter('subcategory', 'debugging')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'plugins',
  'icon'    => 'wand',
  'title'   => 'Plugin development',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'plugins')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'paper',
  'icon'    => 'wand',
  'title'   => 'Logging',
  'layout'  => 'cards',
  'hero'    => true,
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'logging')->sortBy('sort', 'desc')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'wand',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'hero'    => true,
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->sortBy('sort', 'desc')->pluck('id')
]) ?>
