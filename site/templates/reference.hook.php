<?php snippet('reference/entry/header') ?>
<?php snippet('reference/entry/meta') ?>

<?php snippet('toc', $page->text()->headlines('h2')) ?>

<div class="text">
  <h2 id="example"><a href="#example">Example</a></h2>
  <?= $page->example()->kt() ?>
  <?= $page->details()->kt()->anchorHeadlines() ?>
</div>

<?php snippet('reference/entry/footer') ?>
