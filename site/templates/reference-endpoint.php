<?php snippet('cheatsheet.article.header') ?>

  <div class="text">
    <pre class="code"><code class="language-yaml"><?= $page->request() ?></code></pre>

    <?= $page->text()->kt()->anchorHeadlines() ?>

    <?php if ($page->response()->isNotEmpty()): ?>
    <h2 id="response"><a href="#response">Example response</a></h2>

    <figure class="codeblock-figure">
      <figcaption><?= $page->info() ?>: <?= $page->example()->or($page->title()) ?></figcaption>
      <pre class="code language-json code-toolbar"><code class="language-json"><?= $page->response() ?></code></pre>
    </figure>
    <?php endif ?>
  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
