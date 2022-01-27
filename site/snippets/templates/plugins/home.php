

<section id="fields" class="mb-24">
  <h2 class="mb-6 inline-flex items-center bg-light" style="border-radius: 5rem; padding: .25rem 1rem">
    <span class="mr-3"><?= icon('forms') ?></span> Fields
  </h2>

  <div class="columns" style="--columns: 3; --gap: var(--spacing-6)">
    <?php foreach (pages('plugins/sylvainjule/color-palette', 'plugins/sylvainjule/illustrated-radio', 'plugins/oblikstudio/link-field', 'plugins/sylvainjule/locator', 'plugins/fabianmichael/markdown-field', 'plugins/fabianmichael/multi-toggle-field') as $plugin): ?>
    <article class="bg-white rounded overflow-hidden shadow-lg">
      <figure class="bg-light">
        <img src="<?= $plugin->images()->findBy('name', 'screenshot')->url() ?>" style="--aspect-ratio: 4/3; object-position: left top;">
      </figure>
      <div class="p-6">
        <h4 class="font-bold"><?= $plugin->title() ?></h4>
        <p class="mb-3">
          <a href="<?= $plugin->parent()->url() ?>" class="block font-mono text-xs color-gray-500">
          by <span class="color-black"><?= $plugin->parent()->title() ?></span>
          </a>
        </p>
        <div class="prose text-sm">
          <?= $plugin->description() ?>
        </div>
      </div>
    </article>
    <?php endforeach ?>
  </div>
</section>

<section id="seo" class="mb-24">
  <h2 class="mb-6 inline-flex items-center bg-light" style="border-radius: 5rem; padding: .25rem 1rem">
    <span class="mr-3"><?= icon('seo') ?></span> SEO
  </h2>

  <?php foreach (pages(['plugins/diesdasdigital/metaknight']) as $plugin): ?>
  <article class="bg-dark shadow-xl color-gray-400 rounded overflow-hidden shadow columns" style="--columns: 3; --gap: 0">
    <img src="<?= $plugin->images()->findBy('name', 'screenshot')->url() ?>" class="px-3 pt-3" style="--span: 2; --aspect-ratio: 3/1.5; object-position: top center">
    <div class="p-6">
      <h4 class="color-white font-bold"><?= $plugin->title() ?></h4>
      <p class="mb-3">
        <a href="<?= $plugin->parent()->url() ?>" class="block font-mono text-xs color-gray-500">
        by <span class="color-white"><?= $plugin->parent()->title() ?></span>
        </a>
      </p>
      <div class="prose color-gray-400 text-sm">
        <?= $plugin->description() ?>
      </div>
    </div>
  </article>
  <?php endforeach ?>
</section>

<section id="analytics" class="mb-42">
  <h2 class="mb-6 inline-flex items-center bg-light" style="border-radius: 5rem; padding: .25rem 1rem">
    <span class="mr-3"><?= icon('analytics') ?></span> Analytics
  </h2>

  <div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
    <?php foreach (pages('plugins/paulmorel/fathom-analytics', 'plugins/sylvainjule/matomo') as $plugin): ?>
    <article class="bg-white rounded overflow-hidden shadow-lg">
      <figure class="bg-light">
        <img src="<?= $plugin->images()->findBy('name', 'screenshot')->url() ?>" style="--aspect-ratio: 4/3; object-position: left top; mix-blend-mode: multiply">
      </figure>
      <div class="p-6">
        <h4 class="font-bold"><?= $plugin->title() ?></h4>
        <p class="mb-3">
          <a href="<?= $plugin->parent()->url() ?>" class="block font-mono text-xs color-gray-500">
          by <span class="color-black"><?= $plugin->parent()->title() ?></span>
          </a>
        </p>
        <div class="prose text-sm">
          <?= $plugin->description() ?>
        </div>
      </div>
    </article>
    <?php endforeach ?>
  </div>

</section>

