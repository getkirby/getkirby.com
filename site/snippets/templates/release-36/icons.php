<section id="icons">

  <?php snippet('templates/features/intro', [
    'title' => 'Shiny new icons',
    'intro' => 'Improve your fields, tabs and more',
  ]) ?>

  <div class="sr-only">
    <?= F::read($kirby->root('panel') . '/dist/img/icons.svg') ?>
  </div>

  <div class="bg-dark color-gray-400 highlight mb-42">
    <ul class="columns" style="--columns: 4; --gap: var(--spacing-6)">
      <?php foreach ($page->icons()->yaml() as $icon) : ?>
        <li class="flex items-center font-mono text-xs">
          <svg class="mr-3" width="16" height="16" fill="#fff">
            <use href="#icon-<?= $icon ?>" />
          </svg>
          <?= $icon ?>
        </li>
      <?php endforeach ?>
    </ul>
  </div>

</section>
