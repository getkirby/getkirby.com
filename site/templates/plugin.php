<?php layout('plugins') ?>

<style>
  .plugin-summary {
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: var(--spacing-6)
  }

  @media screen and (min-width: 65rem) {
    .plugin-summary {
      grid-template-columns: 1fr 14rem;
    }
  }

  .plugin-author img {
    border-radius: 100%;
    width: 3rem;
  }

  .plugin-links a {
    margin-bottom: 2px;
    width: 100%;
    overflow: hidden;
    background: var(--color-light);
  }
</style>

<article>

  <header class="mb-42">
    <h1 class="h1 block mb-12"><?= $page->title() ?></h1>
    <div class="plugin-summary mb-12">
      <figure>
        <div class="bg-light rounded overflow-hidden shadow-xl mb-6" style="--aspect-ratio: 2/1">
          <?php if ($card = $page->card()) : ?>
            <img src="<?= $card->url() ?>">
          <?php elseif ($page->example()->isNotEmpty()) : ?>
            <div class="bg-black" style="--aspect-ratio: 2/1">
              <div class="flex items-center justify-center">
                <div class="shadow-xl" data-no-copy><?= $page->example()->kt() ?></div>
              </div>
            </div>
          <?php elseif ($logo = $page->logo()) : ?>
            <div class="bg-light" style="--aspect-ratio: 2/1">
              <div class="flex items-center justify-center">
                <div style="height: 66%; --aspect-ratio: 1/1">
                  <img src="<?= $logo->url() ?>" style="object-fit: scale-down; mix-blend-mode: multiply">
                </div>
              </div>
            </div>
          <?php else : ?>
            <div class="block" style="--aspect-ratio: 2/1">
              <span>
                <span class="grid place-items-center" style="height: 100%">
                  <?= icon($page->icon()) ?>
                </span>
              </span>
            </div>
          <?php endif ?>
        </div>
        <figcaption class="prose text-xl color-black">
          <?= $page->description()->kt()->widont() ?>
        </figcaption>
      </figure>
      <nav aria-label="Plugin links" class="plugin-links">
        <a href="<?= $author->url() ?>" class="plugin-author flex flex-column items-center bg-light font-mono text-sm p-6">
          <?php if ($avatar = $author->avatar()) : ?>
            <img class="mb-3 shadow-xl" style="--aspect-ratio: 1/1" src="<?= $avatar->url() ?>">
          <?php endif ?>
          <?= $author->title() ?>
        </a>

        <a class="btn" href="<?= $download ?>">
          <?= icon('download') ?> Download
        </a>

        <?php if ($page->repository()->isNotEmpty()) : ?>
          <a class="btn" href="<?= $page->repository() ?>">
            <?= icon('github') ?> Source
          </a>
        <?php endif ?>

        <?php if ($version = $page->version()) : ?>
          <a class="btn" href="<?= $download ?>">
            <?= icon('git') ?> <?= $version ?>
          </a>
        <?php endif ?>

      </nav>
    </div>

  </header>

  <?php if ($relatedPlugins->count()) : ?>
    <section class="mb-42">
      <h2 class="h2 mb-6">Related plugins</h2>
      <?php snippet('templates/plugins/cards', ['plugins' => $relatedPlugins, 'headingLevel' => 'h3']) ?>
    </section>
  <?php endif ?>

  <?php if ($authorPlugins->count()) : ?>
    <section class="mb-42">
      <h2 class="h2 mb-6">Other plugins by <a href="<?= $author->url() ?>" class="link"><?= $author->title() ?></a></h2>
      <?php snippet('templates/plugins/cards', ['plugins' => $authorPlugins, 'headingLevel' => 'h3']) ?>
    </section>
  <?php endif ?>

</article>
