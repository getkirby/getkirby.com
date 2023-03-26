<?php layout('plugins') ?>

<h1 class="h1 mb-12"><?= $heading ?></h1>

<?php if (empty($currentCategory) === true && empty($filter) === true) : ?>
  <?php snippet('templates/plugins/home') ?>
<?php elseif (empty($filter) === false): ?>
  <?php snippet('templates/plugins/cards') ?>
<?php else : ?>
  <?php snippet('templates/plugins/categories/' . $currentCategory) ?>
<?php endif ?>
