<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'calendar',
  'title'   => 'Calendar integration',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'calendar')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'fields',
  'icon'    => 'calendar',
  'title'   => 'Panel fields',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/adspectus/date-extended',
    'plugins/mullema/date-format'
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'calendar',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
