<style>
.v37-system-grid {
  display: grid;
  grid-gap: var(--spacing-6);
  grid-template-columns: 1fr;
  grid-template-areas: "figure"
                       "box1"
                       "box2"
                       "box3";
}

@media screen and (min-width: 60rem) {
  .v37-system-grid {
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-areas: "figure figure figure"
                        "box1 box2 box3";
  }
}
</style>

<section id="system-view" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New system view',
    'subtitle' => 'Everything system related at a glance',
    'mb'       => 12
  ]) ?>

  <div class="v37-system-grid">
    <figure class="release-box bg-light" style="--aspect-ratio: 2398/1308; grid-area: figure">
      <img src="<?= ($image = $page->image('system.png'))->url() ?>" loading="lazy" alt="The system view has a new design and the new security section with a list of warnings">
    </figure>

    <div class="release-text-box" style="grid-area: box1">
      <h3>Environment</h3>
      <div class="prose">
        Vital information about your environment: License key, version number, PHP version, server software.
      </div>
    </div>

    <div class="release-text-box" style="grid-area: box2">
      <h3>Security</h3>
      <div class="prose">
        Find potential issues and unintentionally exposed parts of your installation (Git repo, content folder, site folder, kirby folder).
      </div>
    </div>

    <div class="release-text-box" style="grid-area: box3">
      <h3>Plugins</h3>
      <div class="prose">
        View all installed plugins, their authors, license and current version number in our redesigned plugins table.
      </div>
    </div>
  </div>
</section>
