<?php layout('plugins') ?>

<article>
  <header>
    <div class="mb-12">
      <h1 class="h1 block">Plugins by <?= $page->title() ?></h1>
    </div>
  </header>

  <?php if ($authorPlugins->count()): ?>
    <section class="mb-42">
      <?php snippet('templates/plugins/plugins', ['plugins' => $authorPlugins, 'headingLevel' => 'h3']) ?>
    </section>
  <?php endif ?>
</article>
