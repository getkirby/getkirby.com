<?php snippet('templates/plugins/section', [
  'id'      => 'template-engines',
  'icon'    => 'code',
  'title'   => 'Template Engines',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'engine')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'assets',
  'icon'    => 'image',
  'title'   => 'Assets',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'assets')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'field-methods',
  'icon'    => 'code',
  'title'   => 'Field methods',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'field-method')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'modules',
  'icon'    => 'code',
  'title'   => 'Modules',
  'layout'  => 'hero',
  'plugins' => ['plugins/medienbaecker/modules']
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'syntax-highlighting',
  'icon'    => 'code',
  'title'   => 'Syntax highlighting',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'syntax-highlighting')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'related',
  'icon'    => 'code',
  'title'   => 'Related content',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'relationships')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'privacy',
  'icon'    => 'code',
  'title'   => 'Privacy',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'privacy')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'feeds',
  'icon'    => 'code',
  'title'   => 'Feeds',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'feeds')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'code',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
