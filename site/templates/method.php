<?php snippet('cheatsheet.article.header') ?>

  <?php snippet('method/call', ['call' => $page->methodCall()]) ?>

  <div class="text">

    <?php snippet('method/parameters',  ['parameters' => $page->parameters()]) ?>
    <?php snippet('method/returns', ['type' => $page->returnType()]) ?>
    <?php snippet('method/throws', ['throws' => $page->throws()]) ?>

    <?= $page->text()->kt()->anchorHeadlines() ?>

    <?php snippet('method/inherits',  ['inherits' => $page->inheritedFrom()]) ?>
    <?php snippet('method/source', ['link' => $page->githubSource()]) ?>
  </div>

<?php snippet('cheatsheet.article.footer') ?>
