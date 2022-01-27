<?php snippet('templates/plugins/section', [
  'id'      => 'block',
  'icon'    => 'forms',
  'title'   => 'Panel',
  'layout'  => 'hero',
  'plugins' => [
    'plugins/microman/form-block'
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'templating',
  'icon'    => 'forms',
  'title'   => 'Templating',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'templating')->filter('similar', '')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'emails',
  'icon'    => 'forms',
  'title'   => 'Email sending',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'emails')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'forms',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/bnomei/htmlpurifier'
  ]
]) ?>
