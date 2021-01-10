<?php snippet('header', [ 'floating' => true ]) ?>

  <main class="main" id="maincontent">

    <article class="wrap">

      <?php snippet('hero') ?>

      <?php

      $headlines = $page->text()->headlines('h2');


      snippet('toc', $headlines);

      ?>

      <div class="text">
        <?= $page->text()->kt()->anchorHeadlines('h2') ?>
      </div>

    </article>
  </main>

<?php snippet('footer') ?>
