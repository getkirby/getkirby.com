<?php layout('plugins') ?>

<h1 class="h1 mb-12"><?= $heading ?></h1>

<?php if (empty($currentCategory) === true) : ?>
  <?php snippet('templates/plugins/home') ?>
<?php else : ?>
  <?php snippet('templates/plugins/categories/' . $currentCategory) ?>
<?php endif ?>
