<!DOCTYPE html>
<html lang="en">
<head>
  <?php snippet('layouts/head') ?>
</head>
<body>
  <?php snippet('layouts/header') ?>
  <main id="main" class="main">
    <?php slot('container') ?>
    <div class="container">
      <?php slot() ?>
      <?php endslot() ?>
    </div>
    <?php endslot() ?>
  </main>
  <?php snippet('layouts/footer') ?>
</body>
</html>
