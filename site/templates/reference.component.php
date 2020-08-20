<?php snippet('reference/entry/header') ?>
<?php snippet('reference/entry/meta') ?>

<div class="text">
  <?= $page->text()->kt()->anchorHeadlines() ?>

  <?php snippet('reference/entry/parameters') ?>
  <?php snippet('reference/entry/returns') ?>
  <?php snippet('reference/entry/source') ?>
</div>

<?php snippet('reference/entry/footer') ?>
