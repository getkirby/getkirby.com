<?php layout() ?>

<style>
.partner-grid {
	--columns: 1;
  --column-gap: var(--spacing-24);
  --row-gap: var(--spacing-12);
}

@media screen and (min-width: 50rem) {
	.partner-grid {
		grid-template-columns: 1fr 1fr;
		grid-auto-rows: auto auto;
		grid-template-areas:
			"hero hero"
			"main side"
	}

	.partner-hero {
		grid-area: hero;
	}
	.partner-intro {
		grid-area: main;
	}
	.partner-info {
		grid-area: side;
	}
}

@media screen and (min-width: 64rem) {
	.partner-grid {
		grid-template-columns: 2fr 1fr;
		grid-template-areas:
			"hero side"
			"main side"
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
	<figure style="--aspect-ratio: 3/2;" class="partner-hero mb-3">
		<?php if ($image = $page->card()): ?>
			<?= $image->resize(1600) ?>
		<?php elseif ($image = $page->avatar()): ?>
			<span class="p-6 bg-light">
				<img
					src="<?= $image->url() ?>"
					class="shadow-xl bg-white"
					style="width: auto; height: 100%;"
				>
			</span>
		<?php endif ?>
	</figure>

	<div class="partner-info">
		<div class="sticky" style="--top: var(--spacing-12)">
			<div class="font-mono text-sm mb-12">
				<?php if ($page->isPlusPartner()): ?>
				<p class="inline-flex py-1 px-3 rounded items-center mb-6" style="background: var(--color-yellow-400)">
					<span class="mr-3"><?= icon('verified') ?></span>
					Certified Kirby Partner
				</p>
				<?php endif ?>

				<p class="text-sm">
					<?= ucfirst(str_replace('+', '', $page->package())) ?>
				</p>
				<p class="color-gray-600 truncate">
					<?= $page->location() ?>
				</p>
				<p>
					<a class="link" href="<?= $page->website() ?>">
						<?= $page->website()->shorturl() ?>
					</a>
				</p>
				<?php if ($page->languages()->isNotEmpty()): ?>
				<p
					class="flex items-center"
					style="gap: var(--spacing-3); margin-top: var(--spacing-10)"
				>
					<?= icon('globe') ?>
					<span class="color-gray-600">
						<?= ucfirst($page->i()) ?> speak <?= $page->languages(true) ?>
					</span>
				</p>
				<?php endif ?>
			</div>

			<div class="partner-expertise">
				<h2 class="h2 mb-6"><?= ucfirst($page->my()) ?> expertise</h2>
				<div class="prose text-base mb-6">
					<?= $page->expertise()->kt() ?>
				</div>
				<a
					href="<?= $page->contactlink()->or($page->website()) ?>"
					class="btn btn--filled"
				>
					<?= icon('mail') ?> Contact
				</a>
			</div>
		</div>
  </div>

	<div class="partner-intro">
		<h2 class="h2 mb-6">About <?= $page->me() ?> </h2>
		<div class="prose text-base">
			<?= $page->description()->kt() ?>
		</div>
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
<?php if ($plugins = $page->plugins()): ?>
  <div class="text-lg mb-24">
    <h2 class="h2 mb-12"><?= ucfirst($page->my()) ?> Kirby Plugins</h2>
    <section class="mb-12">
    <?php if ($plugins->count() === 1 || $plugins->count() === 4): ?>
      <?php snippet('templates/plugins/hero', [
        'plugins' => $hero = $plugins->limit(1)
      ]) ?>
    <?php endif ?>
		<?php snippet('templates/plugins/cards', [
			'plugins' => $plugins->not($hero ?? null),
			'columns' => 3,
			'gap'     => 24
		]) ?>
    </section>
    <footer class="mb-6">
      <a
				class="btn btn--filled"
				href="<?= $plugins->first()->parent()->url() ?>"
			>
        <?= icon('flash') ?> Visit <?= $page->my() ?> plugins page
      </a>
    </footer>
  </div>
<?php endif ?>
