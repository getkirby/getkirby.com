<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'wand',
  'title'   => 'Logging',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'logging')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'wand',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
