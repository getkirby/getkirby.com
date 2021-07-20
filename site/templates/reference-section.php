<?php layout('reference') ?>

<?php slot('toc') ?>
<?php endslot() ?>

<?php slot() ?>
<div class="mb-24">
  <?php snippet('templates/reference/advanced') ?>
  <?php snippet('templates/reference/section', $entries) ?>
</div>

<?php snippet('toc') ?>

<div class="prose">
  <?= $page->text()->kt() ?>
</div>
<?php endslot() ?>
