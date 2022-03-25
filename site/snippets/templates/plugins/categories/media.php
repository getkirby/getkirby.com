<?php snippet('templates/plugins/section', [
  'id'      => 'podcasts',
  'icon'    => 'image',
  'title'   => 'Podcasts',
  'layout'  => 'hero',
  'plugins' => ['plugins/mauricerenck/podcaster']
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'images',
  'icon'    => 'image',
  'title'   => 'Images',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'images')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'videos',
  'icon'    => 'image',
  'title'   => 'Videos',
  'layout'  => 'cards',
  'columns' => 2,
  'hero'    => true,
  'plugins' => array_merge(
    [
      'plugins/sylvainjule/embed',
      'plugins/hashandsalt/video'
    ],
    $plugins->filter('subcategory', 'videos')->pluck('id'),
  )
]) ?>

