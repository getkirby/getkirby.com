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

        <nav aria-label="Plugin links" class="auto-fill items-center" style="--min: 10rem;">
          <a class="btn btn--filled" href="<?= $download ?>">
            <?= icon('download') ?>Download <?= $page->version() ?>
          </a>

          <?php if ($page->repository()->isNotEmpty()): ?>
          <a class="btn btn--filled" href="<?= $page->repository() ?>">
            <?= icon('github') ?>Source
          </a>
          <?php endif ?>
        </nav>
      </div>

      <?php if ($image = $page->screenshot()): ?>
      <figure>
        <a class="block" data-lightbox href="<?= $image->url() ?>">
          <?= $image->resize(600)->html(['class' => 'shadow-2xl']) ?>
        </a>
      </figure>
      <?php endif ?>
    </div>

  </header>

  <?php if ($authorPlugins->count()): ?>
  <section class="mb-42">
    <h2 class="h2 mb-6">Other plugins by <?= $author->title() ?></h2>
    <?php snippet('templates/plugins/plugins', ['plugins' => $authorPlugins, 'headingLevel' => 'h3']) ?>
  </section>
  <?php endif ?>

  <?php if ($relatedPlugins->count()): ?>
  <section>
    <h2 class="h2 mb-6">Related plugins</h2>
    <?php snippet('templates/plugins/plugins', ['plugins' => $relatedPlugins, 'headingLevel' => 'h3']) ?>
  </section>
  <?php endif ?>
</article>
