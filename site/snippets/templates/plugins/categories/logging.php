<?php snippet('templates/plugins/section', [
  'id'      => 'paper',
  'icon'    => 'wand',
  'title'   => 'Debugging',
  'layout'  => 'hero',
  'columns' => 1,
  'plugins' => $plugins->filter('subcategory', 'debugging')->pluck('id')
]) ?>


<?php snippet('templates/plugins/section', [
  'id'      => 'paper',
  'icon'    => 'wand',
  'title'   => 'Logging',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'paper',
  'icon'    => 'wand',
  'title'   => 'Panel extensions',
  'layout'  => 'hero',
  'plugins' => $plugins->filter('subcategory', 'panel')->pluck('id')
]) ?>

