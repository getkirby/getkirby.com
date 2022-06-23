<section id="system-view" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New toggles field',
    'subtitle' => 'So many options',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 3; --gap: var(--spacing-6)">

    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 4/2.25; --span: 2">
      <div class="grid place-items-center">
        <img src="<?= ($image = $page->image('toggles-labels.png'))->url() ?>" loading="lazy" style="height: 5rem; width: auto">
      </div>
    </figure>

    <div class="bg-black p-1 rounded-xl overflow-hidden grid items-center">
      <?= $page->togglesWithLabels()->kt() ?>
    </div>

    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 4/2.25; --span: 2">
      <div class="grid place-items-center">
        <img src="<?= ($image = $page->image('toggles-labels-icons.png'))->url() ?>" loading="lazy" style="height: 5rem; width: auto">
      </div>
    </figure>

    <div class="bg-black p-1 rounded-xl overflow-hidden grid items-center">
      <?= $page->togglesWithLabelsAndIcons()->kt() ?>
    </div>

    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 4/2.25; --span: 2">
      <div class="grid place-items-center">
        <img src="<?= ($image = $page->image('toggles-icons.png'))->url() ?>" loading="lazy" style="height: 5rem; width: auto">
      </div>
    </figure>

    <div class="bg-black p-1 rounded-xl overflow-hidden grid items-center">
      <?= $page->togglesWithIcons()->kt() ?>
    </div>

    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 4/2.25; --span: 2">
      <div class="grid place-items-center">
        <img src="<?= ($image = $page->image('toggles-compact.png'))->url() ?>" loading="lazy" style="height: 5rem; width: auto">
      </div>
    </figure>

    <div class="bg-black p-1 rounded-xl overflow-hidden grid items-center">
      <?= $page->togglesCompact()->kt() ?>
    </div>
  </div>

</section>
