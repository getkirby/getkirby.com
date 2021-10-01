<?php layout('plugins') ?>

<article>

  <header>

    <div class="columns mb-42" style="--columns-md: 1; --columns: 2; --gap: var(--spacing-12);">
      <div class="mb-6">
        <h1 class="h1 block mb-12"><?= $page->title() ?></h1>
        <div class="prose mb-6">
          <div class="intro">
            <?= $page->description()->kt()->widont() ?>
          </div>
        </div>
      </div>
    </div>

  </header>

  <?php if ($authorPlugins->count()): ?>
  <section class="mb-42">
    <h2 class="h2 mb-6">Plugins by <?= $author->title() ?></h2>
    <?php snippet('templates/plugins/plugins', ['plugins' => $authorPlugins, 'headingLevel' => 'h3']) ?>
  </section>
  <?php endif ?>
</article>
