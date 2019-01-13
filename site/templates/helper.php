<?php snippet('cheatsheet.article.header') ?>

  <?php snippet('method/call', ['call' => $page->methodCall()]) ?>

  <div class="text">

    <?php snippet('method/parameters',  ['parameters' => $page->parameters()]) ?>
    <?php snippet('method/returns', ['type' => $page->returnType()]) ?>

    <?= $page->text()->kt()->anchorHeadlines() ?>

    <?php snippet('method/source', ['link' => $page->githubSource()]) ?>

  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
