<?php snippet('header') ?>

  <main class="text-page | main" id="maincontent">
    <article class="wrap">

      <?php snippet('hero') ?>

      <div class="text-page-layout">
        <aside class="text-page-sidebar">
          <?php snippet('prose/toc', ['field' => $page->text() ]) ?>
        </aside>
        <div class="text-page-body text">
          <?= $page->text()->kt()->anchorHeadlines(); ?>
        </div>
      </div>

    </article>
  </main>

<?php snippet('footer') ?>
