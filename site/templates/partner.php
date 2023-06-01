<?php layout() ?>

<style>
.partner-grid {
  --columns: 3;
  --column-gap: var(--spacing-24);
  --row-gap: var(--spacing-12);
}

.partner-card {
  --span-lg: 2;
  --span-md: 3;
}

.partner-info {
  --span-lg: 1;
  --span-md: 3;
}

@media screen and (min-width: 40rem) and (max-width: 71.99rem) {
  .partner-info {
    display: grid;
    grid-column-gap: var(--column-gap);
    grid-template-columns: 1fr auto;
  }

  .partner-expertise {
    order: -1;
  }
}
</style>

<header class="mb-12">
  <h1 class="h1 mb-1">
    <?= $page->title() ?>
  </h1>
  <p class="text-sm color-gray-600 font-mono">
    <?= $page->subtitle() ?>
  </p>
</header>

<div class="partner-grid columns mb-24">
  <div class="partner-card">
    <figure style="--aspect-ratio: 3/2;" class="mb-3">
      <?php if ($image = $page->card()): ?>
        <?= $image->resize(1600) ?>
      <?php elseif ($image = $page->avatar()): ?>
        <span class="p-6 bg-light">
          <img class="shadow-xl bg-white" style="width: auto; height: 100%;" src="<?= $image->url() ?>">
        </span>
      <?php endif ?>
    </figure>
  </div>

  <div class="partner-info">
    <div class="font-mono text-sm mb-12">
      <?php if ($page->isPlusPartner()): ?>
      <p class="inline-flex py-1 px-3 rounded items-center mb-6" style="background: var(--color-yellow-400)">
        <span class="mr-3"><?= icon('verified') ?></span>
        Certified Kirby Partner
      </p>
      <?php endif ?>
			<p class="text-sm"><?= ucfirst(str_replace('+', '', $page->package())) ?></p>
      <p class="color-gray-600 truncate">
        <?= $page->location() ?>
      </p>
      <p>
        <a class="link" href="<?= $page->website() ?>">
          <?= $page->website()->shorturl() ?>
        </a>
      </p>
      <?php if ($page->languages()->isNotEmpty()): ?>
      <p class="flex items-center" style="gap: var(--spacing-3); margin-top: var(--spacing-10)">
        <?= icon('globe') ?>
				<span class="color-gray-600"><?= ucfirst($page->i()) ?> speak <?= $page->languages() ?></span>
      </p>
      <?php endif ?>
    </div>

    <div class="partner-expertise">
      <h2 class="h2 mb-6"><?= ucfirst($page->my()) ?> expertise</h2>
      <div class="prose text-base mb-6">
        <?= $page->expertise()->kt() ?>
      </div>
      <a class="btn btn--filled" href="<?= $page->contactlink()->or($page->website()) ?>">
        <?= icon('mail') ?> Contact
      </a>
    </div>
  </div>
</div>

<div class="mb-24">
  <h2 class="h2 mb-6">About <?= $page->me() ?> </h2>
  <div class="prose text-base">
    <?= $page->description()->kt() ?>
  </div>
</div>

<!-- Projects -->
<?php if ($page->children()->isNotEmpty()): ?>
  <div class="text-lg mb-24">
    <h2 class="h2 mb-12"><?= ucfirst($page->my()) ?> Kirby Projects</h2>
    <section>
      <div class="columns" style="--columns: 3; --gap: var(--spacing-24)">
        <?php foreach ($page->children() as $project) : ?>
          <article>

            <figure>
              <a href="<?= $project->link() ?>" target="_blank">
                <div style="--aspect-ratio: 3/4" class="bg-light mb-6">
                  <?php if ($image = $project->image()): ?>
                    <?= $image->name() === 'example' ? $image : $image->resize(800) ?>
                  <?php endif ?>
                </div>
                <figcaption class="font-mono text-sm mb-3">
                  <h3 class="h6 truncate link">
                    <?= $project->title() ?>
                  </h3>
                  <?php if ($project->client()->isNotEmpty()): ?>
                  <p class="color-gray-600">
                    Client: <?= $project->client() ?>
                  </p>
                  <?php endif ?>
                </figcaption>
              </a>
            </figure>

          </article>
        <?php endforeach ?>
      </div>
    </section>
  </div>
<?php endif ?>

<!-- Plugins -->
<?php if ($plugins = $page->pluginpage()->toPage()): ?>
  <div class="text-lg mb-24">
    <h2 class="h2 mb-12"><?= ucfirst($page->my()) ?> Kirby Plugins</h2>
    <section class="mb-12">
    <?php if ($plugins->children()->count() === 1): ?>
      <?php snippet('templates/plugins/hero', [
        'plugins' => $plugins->children()->limit(1)
      ]) ?>
    <?php else: ?>
      <?php snippet('templates/plugins/cards', [
        'plugins' => $plugins->children()->limit($page->isPlusPartner() ? 6 : 3),
        'columns' => $plugins->children()->count() > 2 ? 3 : 2,
        'gap'     => 24
      ]) ?>
    <?php endif ?>
    </section>
    <footer class="mb-6">
      <a class="btn btn--filled" href="<?= $plugins->url() ?>">
        <?= icon('flash') ?> Visit <?= $page->my() ?> plugins page
      </a>
    </footer>
  </div>
<?php endif ?>
