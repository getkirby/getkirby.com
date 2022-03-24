<?php snippet('templates/plugins/section', [
  'id'      => 'tools',
  'icon'    => 'image',
  'title'   => 'Dev tools',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'tools')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'images',
  'icon'    => 'image',
  'title'   => 'Images',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'images')->pluck('id')
]) ?>

