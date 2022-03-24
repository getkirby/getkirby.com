<?php snippet('templates/plugins/section', [
  'id'      => 'pwa',
  'icon'    => 'performance',
  'title'   => 'PWA',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'pwa')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'cachedrivers',
  'icon'    => 'performance',
  'title'   => 'Cachedrivers',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'cachedriver')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'caching',
  'icon'    => 'performance',
  'title'   => 'Caching',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'caching')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'cachebusting',
  'icon'    => 'performance',
  'title'   => 'Cachebusting',
  'layout'  => 'cards',
  'plugins' => $plugins->filter('subcategory', 'cachebusting')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'cdns',
  'icon'    => 'performance',
  'title'   => 'CDNs',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'cdn')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'optimizations',
  'icon'    => 'analytics',
  'title'   => 'Optimizations',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'optimization')->pluck('id')
]) ?>

