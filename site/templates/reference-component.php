<?php snippet('cheatsheet.article.header') ?>

  <div class="text">

    <?= $page->text()->kt()->anchorHeadlines() ?>

    <?php snippet('method/parameters',  ['parameters' => $page->parameters()]) ?>
    <?php snippet('method/returns', ['type' => $page->returnType()]) ?>

    <?php snippet('method/source', ['link' => $page->githubSource()]) ?>

  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
