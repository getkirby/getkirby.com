<?php snippet('header') ?>

  <main class="v3-page | main" id="maincontent">
    <article class="wrap">
      <?php snippet('hero', ['align' => 'center']) ?>

      <div class="text">
        <hr>
        <?= $page->text()->kt()->anchorHeadlines() ?>
      </div>
    </article>
  </main>

<?php snippet('footer') ?>
