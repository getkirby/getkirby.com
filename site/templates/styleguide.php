<?php snippet('header', [ 'floating' => true ]) ?>

  <main class="main" id="maincontent">

    <article class="wrap">

      <?php snippet('hero') ?>
      <?php snippet('prose/toc', ['field' => $page->text()]) ?>

      <div class="text">
        <?= $page->text()->kt()->anchorHeadlines('h2') ?>
      </div>

    </article>
  </main>

<?php snippet('footer') ?>
