<?php layout('cookbook') ?>

<?php slot('h1') ?>
<?= $page->title()->widont() ?>
<?php endslot() ?>

<?php slot() ?>
<?php snippet('toc', ['title' => 'In this recipe']) ?>
<div class="prose">
  <?= $page->text()->kt() ?>
</div>
<?php endslot() ?>

