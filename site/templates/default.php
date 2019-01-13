<?php snippet('header') ?>

  <main class="default-page | main" id="maincontent">
    <article class="wrap">
      <?php snippet('hero', ['align' => 'center']) ?>
      <?= $page->text()->kt()->anchorHeadlines() ?>
    </article>
  </main>

<?php snippet('footer') ?>
