<?php snippet('templates/plugins/section', [
  'id'      => 'static-site-generator',
  'icon'    => 'integration',
  'title'   => 'Static Site Generator',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'static-site-generator')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'headless',
  'icon'    => 'integration',
  'title'   => 'Headless',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'headless')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'emails',
  'icon'    => 'mail',
  'title'   => 'Emails',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'emails')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'podcasts',
  'icon'    => 'integration',
  'title'   => 'Podcasts',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'podcasts')->pluck('id')
]) ?>

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
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'social')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'feeds',
  'icon'    => 'integration',
  'title'   => 'Feeds',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'feeds')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'integration',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
