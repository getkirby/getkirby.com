<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('templates/guide/sidebar', [
  'title'  => 'Guide',
  'menu'   => page('docs/guide')->children()->listed(),
  'sticky' => false
]) ?>
<?php endslot() ?>
