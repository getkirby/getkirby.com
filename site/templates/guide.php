<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('templates/guide/sidebar', [
  'title'  => 'Guide',
  'link'   => '/docs/guide',
  'menu'   => page('docs/guide')->children()->listed(),
  'sticky' => false
]) ?>
<?php endslot() ?>
