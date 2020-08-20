<?php snippet('reference/entry/header') ?>
<?php snippet('reference/entry/meta') ?>

<div class="text">
  <h2 id="example"><a href="#example">Example</a></h2>
  <?= $page->example()->kt() ?>

  <h2 id="custom-setup"><a href="#custom-setup">Custom setup</a></h2>
  <?= $page->setup() ?>

  <?= $page->text()->kt() ?>
</div>

<?php snippet('reference/entry/footer') ?>
