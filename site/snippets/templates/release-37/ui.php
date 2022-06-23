<section id="ui" class="mb-42">

  <div class="sr-only">
    <?= F::read($kirby->root('panel') . '/dist/img/icons.svg') ?>
  </div>

  <?php snippet('hgroup', [
    'title'    => 'Refined UI',
    'subtitle' => 'A fresh new look for your Panel',
    'mb'       => 12
  ]) ?>

  <div class="columns">

    <div class="bg-light rounded-xl overflow-hidden" style="--span: 4">
      <figure style="--aspect-ratio: 1/1">
        <?= $page->image('pages.png') ?>
      </figure>
    </div>

    <div class="bg-light rounded-xl overflow-hidden" style="--span: 4">
      <figure style="--aspect-ratio: 1/1">
        <?= $page->image('fields.png') ?>
      </figure>
    </div>

    <div class="p-12 bg-white rounded-xl" style="--span: 4">
      <h3 class="text-lg font-bold">Fresh & familiar</h3>
      <div class="prose text-lg">
        A bit more round, a bit more friendly, just a bit more cosy and yet you will feel instantly at home.
      </div>
    </div>

    <div class="bg-white highlight rounded-xl" style="--span: 3">
      <h3 class="text-lg font-bold mb-6">New icons</h3>
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

    <div class="highlight bg-light rounded-xl overflow-hidden" style="--span: 9">
      <h3 class="text-lg font-bold mb-6">New file icons</h3>
      <figure style="--aspect-ratio: 921/415">
        <?= $page->image('fileicons.png') ?>
      </figure>
    </div>


</section>
