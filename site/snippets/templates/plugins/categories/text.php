<?php snippet('templates/plugins/section', [
  'id'      => 'kirbytags',
  'icon'    => 'image',
  'title'   => 'Kirbytext',
  'layout'  => 'cards',
  'columns' => 4,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
