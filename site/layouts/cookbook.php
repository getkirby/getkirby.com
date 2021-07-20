<!DOCTYPE html>
<html lang="en">
<head>
  <?php snippet('layouts/head') ?>
</head>
<body>
  <?php snippet('layouts/header') ?>
  <main id="main" class="main">
    <div class="container">
      <div class="with-sidebar">
        <article class="mb-24">
          <?php slot('hero') ?>
          <header class="mb-12">
            <h1 class="h1"><?php slot('h1') ?><?php endslot() ?></h1>
          </header>
          <?php endslot() ?>
          <div class="mb-24">
            <?php slot() ?>
            <?php endslot() ?>
          </div>
          <footer>
            <?php snippet('layouts/github-edit') ?>
          </footer>
        </article>
        <?php snippet('templates/cookbook/sidebar') ?>
      </div>
    </div>
  </main>
  <?php snippet('layouts/footer') ?>
</body>
</html>
