<?php snippet('cheatsheet.article.header') ?>

  <?php snippet('method/call', ['call' => $page->methodCall()]) ?>

  <div class="text">
    <?php snippet('method/parameters',  ['parameters' => $page->parameters()]) ?>
    <?php snippet('method/returns', ['type' => $page->returnType()]) ?>

    <?php if (empty($page->aliases()) === false): ?>
    <h2>Aliases</h2>
    <p>You can use the following aliases for this field method in your template.</p>
    <ul>
      <?php foreach ($page->aliases() as $alias): ?>
      <li><code>$field-><?= $alias ?>( ... )</code></li>
      <?php endforeach ?>
    </ul>
    <?php endif ?>

    <?= $page->text()->kt()->anchorHeadlines() ?>

    <?php snippet('method/source', ['link' => $page->githubSource()]) ?>
  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
