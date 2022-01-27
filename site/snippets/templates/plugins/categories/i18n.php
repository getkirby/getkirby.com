<?php snippet('templates/plugins/section', [
  'id'      => 'integration',
  'icon'    => 'globe',
  'title'   => 'Integration',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'integration')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'panel',
  'icon'    => 'globe',
  'title'   => 'Panel extensions',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'panel')->pluck('id')
]) ?>


<?php snippet('templates/plugins/section', [
  'id'      => 'utilities',
  'icon'    => 'globe',
  'title'   => 'Utilities',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>

