<?php snippet('cheatsheet.article.header') ?>

  <?php snippet('prose/toc', ['field' => $page->text() ]) ?>

  <div class="text">
    <?= $page->text()->kt()->anchorHeadlines() ?>
  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
