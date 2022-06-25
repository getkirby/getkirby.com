<section id="system-view" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New system view',
    'subtitle' => 'All systems go',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 3; --gap: var(--spacing-6)">
    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 1433/651; --span: 3">
      <img src="<?= ($image = $page->image('system.png'))->url() ?>" loading="lazy">
    </figure>

    <div class="p-12 bg-white rounded-xl">
      <h3 class="text-xl font-bold">Environment</h3>
      <div class="prose">
        Get vital information about your installation at a glance: License key, version number, PHP version, server software.
      </div>
    </div>

    <div class="p-12 bg-white rounded-xl">
      <h3 class="text-xl font-bold">Security</h3>
      <div class="prose">
        Find potential issues and unintentionally exposed parts of your installation (Git repo, content folder, site folder, kirby folder)
      </div>
    </div>

    <div class="p-12 bg-white rounded-xl">
      <h3 class="text-xl font-bold">Plugins</h3>
      <div class="prose">
        See all installed plugins, their authors, license and current version number in our redesigned plugins table.
      </div>
    </div>

  </div>

</section>
