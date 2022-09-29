<section id="migration" class="mb-42">

  <?php snippet('hgroup', [
    'title' => 'Migration',
    'mb'    => 12
  ]) ?>

  <div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
    <div class="release-padded-box bg-light">
      <h3 class="h3 mb-6">For site developers</h3>
      <div class="prose text-sm">
        <?= $page->migrationForSiteDevelopers()->kt() ?>
      </div>
    </div>

    <div class="release-padded-box bg-light">
      <h3 class="h3 mb-6">For plugin developers</h3>
      <div class="prose text-sm">
        <?= $page->migrationForPluginDevelopers()->kt() ?>
      </div>
    </div>
  </div>

</section>
