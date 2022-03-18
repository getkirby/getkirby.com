<?php snippet('templates/plugins/section', [
  'id'      => 'pwa',
  'icon'    => 'performance',
  'title'   => 'PWA',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'pwa')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'caching',
  'icon'    => 'performance',
  'title'   => 'Caching',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'caching')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'cdns',
  'icon'    => 'performance',
  'title'   => 'CDNs',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'cdn')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'optimizations',
  'icon'    => 'analytics',
  'title'   => 'Optimizations',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', 'optimization')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'analytics',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 3,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
