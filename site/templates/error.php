<?php snippet('header') ?>

  <main class="error-page | main" id="maincontent">
    <article class="wrap">
      <?php snippet('hero', ['align' => 'center']) ?>

      <div class="text">
        <?= $page->text()->kt() ?>
      </div>
    </article>
  </main>

  <?php snippet('footer') ?>
