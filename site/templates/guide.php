<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('sidebar', [
  'title' => 'Guide',
  'link'  => '/docs/guide',
  'menu'  => page('docs/guide')->children()->listed(),
]) ?>
<?php endslot() ?>
