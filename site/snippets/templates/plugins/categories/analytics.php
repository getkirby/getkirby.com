<?php snippet('templates/plugins/section', [
  'id'      => 'dashboards',
  'icon'    => 'analytics',
  'title'   => 'Dashboards',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/paulmorel/fathom-analytics',
    'plugins/sylvainjule/matomo',
    'plugins/rowdyrabouw/plausible',
    'plugins/daandelange/simplestats',
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'ab-testing',
  'icon'    => 'analytics',
  'title'   => 'A/B Testing',
  'layout'  => 'hero',
  'plugins' => [
    'plugins/hashandsalt/abt',
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'analytics',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/bnomei/pageviewcounter',
    'plugins/kx550/fathom',
  ]
]) ?>
