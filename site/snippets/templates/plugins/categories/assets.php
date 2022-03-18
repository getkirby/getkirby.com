<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'image',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
