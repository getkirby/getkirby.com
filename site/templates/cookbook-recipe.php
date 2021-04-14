<?php layout('cookbook') ?>

<?php slot('h1') ?>
<?= $page->title()->widont() ?>
<?php endslot() ?>

<?php slot() ?>
<div class="prose">
  <?= $page->text()->kt() ?>
</div>
<?php endslot() ?>

