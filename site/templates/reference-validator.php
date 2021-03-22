<?php snippet('cheatsheet.article.header') ?>

  <div class="text">
    <?php snippet('method/call', ['call' => $page->methodCall()]) ?>

    <?php snippet('method/parameters',  ['parameters' => $page->parameters()]) ?>
    <?php snippet('method/returns', ['type' => 'bool']) ?>

    <?= $page->text()->kt() ?>

    <?php snippet('method/source', ['link' => $page->githubSource()]) ?>
  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
