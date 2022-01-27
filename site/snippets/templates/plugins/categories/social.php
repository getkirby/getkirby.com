<?php snippet('templates/plugins/section', [
  'id'      => 'indieweb',
  'icon'    => 'integration',
  'title'   => 'Indieweb',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'indieweb')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'social',
  'icon'    => 'integration',
  'title'   => 'Social networking',
  'layout'  => 'cards',
  'columns' => 4,
  'hero'    => true,
  'plugins' => array_merge(
    [
      'plugins/sylvainjule/embed'
    ],
    $plugins->filter('subcategory', 'social')->filter('similar', '')->pluck('id')
  )
]) ?>


