<section id="toggles-field" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New toggles field',
    'subtitle' => 'Stylish options you will love',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 3; --gap: var(--spacing-6)">

    <div class="release-box bg-light grid items-center" style="--span: 2">
      <figure style="--aspect-ratio: 800/500">
        <img src="<?= ($image = $page->image('toggles-labels.png'))->url() ?>" loading="lazy">
      </figure>
    </div>

    <div class="release-code-box">
      <?= $page->togglesWithLabels()->kt() ?>
    </div>

    <div class="release-box bg-light grid items-center" style="--span: 2">
      <figure style="--aspect-ratio: 800/500">
        <img src="<?= ($image = $page->image('toggles-labels-icons.png'))->url() ?>" loading="lazy">
      </figure>
    </div>

    <div class="release-code-box">
      <?= $page->togglesWithLabelsAndIcons()->kt() ?>
    </div>

    <div class="release-box bg-light grid items-center" style="--span: 2">
      <figure style="--aspect-ratio: 800/500">
        <img src="<?= ($image = $page->image('toggles-icons.png'))->url() ?>" loading="lazy">
      </figure>
    </div>

    <div class="release-code-box">
      <?= $page->togglesWithIcons()->kt() ?>
    </div>

    <div class="release-box bg-light grid items-center" style="--span: 2">
      <figure style="--aspect-ratio: 800/500">
        <img src="<?= ($image = $page->image('toggles-compact.png'))->url() ?>" loading="lazy">
      </figure>
    </div>

    <div class="release-code-box">
      <?= $page->togglesCompact()->kt() ?>
    </div>
  </div>
</section>
