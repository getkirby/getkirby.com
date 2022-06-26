<style>
.v37-ui-grid {
  display: grid;
  grid-gap: var(--spacing-6);
  grid-template-columns: 1fr;
}

@media screen and (min-width: 45rem) {
  .v37-ui-grid {
    grid-template-columns: 1fr 1fr;
  }
}

@media screen and (min-width: 60rem) {
  .v37-ui-grid {
    grid-template-columns: 1fr 1fr 1fr;
  }
  .v37-ui-grid > :nth-child(2) {
    grid-column: span 2;
  }
}

@media screen and (min-width: 90rem) {
  .v37-ui-grid {
    grid-template-columns: 1fr 1fr 1fr 1fr;
  }
  .v37-ui-grid > :nth-child(2) {
    grid-column: span 3;
  }
}
</style>

<section id="ui" class="mb-42">
  <div class="sr-only">
    <?= F::read($kirby->root('panel') . '/dist/img/icons.svg') ?>
  </div>

  <?php snippet('hgroup', [
    'title'    => 'Refined UI',
    'subtitle' => 'A fresh new look for your Panel',
    'mb'       => 12
  ]) ?>

  <div class="columns mb-6" style="--columns: 3">
    <div class="release-box bg-light">
      <figure style="--aspect-ratio: 1/1">
        <img src="<?= $page->image('pages.png')->url() ?>" loading="lazy" alt="The card design shows the new rounded corners that have been introduced throughout the Panel">
      </figure>
    </div>

    <div class="release-box bg-light">
      <figure style="--aspect-ratio: 1/1">
        <img src="<?= $page->image('fields.png')->url() ?>" loading="lazy" alt="Fields also feature a more rounded look">
      </figure>
    </div>

    <div class="release-text-box">
      <h3>Fresh & familiar</h3>
      <div class="prose">
        Slightly rounder, friendlier, and more cosy: you will feel instantly at home.
      </div>
    </div>
  </div>

  <div class="v37-ui-grid">
    <div class="release-text-box">
      <h3 class="mb-6">New icons</h3>
      <ul class="columns" style="--columns: 1; --gap: var(--spacing-3)">
        <?php foreach ($page->icons()->yaml() as $icon) : ?>
          <li class="flex items-center font-mono text-xs">
            <svg class="mr-3" width="16" height="16">
              <use href="#icon-<?= $icon ?>" />
            </svg>
            <?= $icon ?>
          </li>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="release-padded-box bg-light">
      <h3 class="mb-6">New file icons</h3>
      <figure style="--aspect-ratio: 1968/834">
        <img src="<?= $page->image('fileicons.png')->url() ?>" loading="lazy" alt="The placeholder icons for all kinds of file types – documents, videos, spreadsheets, etc.">
      </figure>
    </div>
  </div>
</section>
