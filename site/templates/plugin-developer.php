<?php layout('plugins') ?>

<article>
  <header>
    <div class="mb-12 flex items-center">
      <?php if ($avatar = $page->avatar()): ?>
      <img class="shadow-xl mr-3" src="<?= $avatar->url() ?>" style="border-radius: 100%; width: 3rem; height: 3rem; --aspect-ratio: 1/1">
      <?php endif ?>

      <h1 class="h1 block">
        <?= $page->title() ?>
      </h1>
    </div>
  </header>

  <?php if ($authorPlugins->count()) : ?>
    <section class="mb-42">
      <?php snippet('templates/plugins/cards', ['plugins' => $authorPlugins, 'headingLevel' => 'h3', 'columns' => 2]) ?>
    </section>
  <?php endif ?>
</article>
