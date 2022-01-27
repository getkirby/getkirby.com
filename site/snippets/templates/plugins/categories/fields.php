<?php snippet('templates/plugins/section', [
  'id'      => 'images',
  'icon'    => 'input',
  'hero'    => true,
  'title'   => 'Images',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'images')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'editing',
  'icon'    => 'input',
  'title'   => 'Editing',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'editing')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'colors',
  'icon'    => 'input',
  'title'   => 'Colors',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'colors')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'videos',
  'icon'    => 'input',
  'title'   => 'Videos',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'videos')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'maps',
  'icon'    => 'input',
  'title'   => 'Maps',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'maps')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'layout',
  'icon'    => 'input',
  'title'   => 'Layout',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'layout')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'navigation',
  'icon'    => 'input',
  'title'   => 'Navigation',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'navigation')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'structured-content',
  'icon'    => 'input',
  'title'   => 'Structured content',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'structured-content')->pluck('id')
]) ?>


<?php snippet('templates/plugins/section', [
  'id'      => 'dates',
  'icon'    => 'input',
  'title'   => 'Dates',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'dates')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'editing',
  'icon'    => 'input',
  'title'   => 'Helper fields',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'enhancements',
  'icon'    => 'input',
  'title'   => 'Field enhancements',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'enhancement')->pluck('id')
]) ?>

