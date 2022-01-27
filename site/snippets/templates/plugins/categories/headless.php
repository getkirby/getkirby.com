<?php snippet('templates/plugins/section', [
  'id'      => 'static-site-generator',
  'icon'    => 'integration',
  'title'   => 'Static Site Generator',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'static-site-generator')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'api',
  'icon'    => 'integration',
  'title'   => 'APIs',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'api')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'authentication',
  'icon'    => 'integration',
  'title'   => 'Authentication',
  'layout'  => 'cardlets',
  'columns' => 3,
  'plugins' => page('plugins')->grandChildren()->filter('category', 'security')->filter('subcategory', 'authentication')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'fields',
  'icon'    => 'integration',
  'title'   => 'Fields',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/rasteiner/query-field',
    'plugins/pju/kirby-webhook-field'
  ]
]) ?>
