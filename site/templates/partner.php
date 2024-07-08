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

.partner-meta div {
	display: flex;
	align-items: center;
	gap: .5rem;
}
.partner-meta div + div {
	margin-top: .25rem;
}
.partner-meta dd {
	color: var(--color-gray-700);
}
</style>

<header class="mb-12">
	<h1 class="h1 mb-1">
		<?= $page->title() ?>
	</h1>
	<p class="text-sm color-gray-700 font-mono">
		<?= $page->subtitle() ?>
	</p>
</header>

<div class="partner-grid columns mb-24">
	<figure style="--aspect-ratio: 3/2;" class="partner-hero rounded overflow-hidden mb-3">
		<?php if ($image = $page->card()): ?>
			<?= img($image, [
				'alt' => '',
				'src' => [
					'width' => 1000
				],
				'lazy' => false,
				// sizes generated with https://ausi.github.io/respimagelint/
				'sizes' => '(min-width: 1520px) 768px, (min-width: 1160px) calc(55vw - 57px), (min-width: 1040px) calc(67vw - 132px), (min-width: 480px) calc(100vw - 96px), 90vw',
				'srcset' => [
					300,
					500,
					768,
					1000,
					1536
				]
			]) ?>
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

				<?php if ($page->isCertified()): ?>
				<button class="inline-flex py-1 px-3 rounded items-center mb-6" style="gap: .5rem; background: var(--color-yellow-400); border: 1px solid transparent" onclick="infoDialog.showModal()">
					<?= icon('verified') ?>
					Certified Kirby Partner
				</button>
				<?php else: ?>
				<p class="inline-flex py-1 px-3 rounded mb-6" style="border: 1px solid var(--color-gray-400)">Kirby Partner</p>
				<?php endif ?>

				<dl class="partner-meta">
					<div>
						<dt title="Location"><?= icon('map') ?></dt>
						<dd><?= $page->location() ?></dd>
					</div>
					<div>
						<dt title="People"><?= icon('users') ?></dt>
						<dd><?= $page->peopleLabel() ?></dd>
					</div>
					<?php if ($page->languages()->isNotEmpty()): ?>
					<div>
						<dt title="Languages"><?= icon('globe') ?></dt>
						<dd>
							<?= ucfirst($page->i()) ?> speak <?= $page->languages(true) ?>
						</dd>
					</div>
					<?php endif ?>
					<div>
						<dt title="Website"><?= icon('url') ?></dt>
						<dd>
							<a class="link" href="<?= $page->website() ?>">
								<?= $page->website()->shorturl() ?>
							</a>
						</dd>
					</div>
				</dl>
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
					<?= icon('email') ?> Contact
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
				<?php foreach ($page->children() as $project): ?>
					<article>
						<figure>
							<a href="<?= $project->link() ?>" target="_blank">
								<div style="--aspect-ratio: 3/4" class="bg-light mb-6 shadow-lg">
									<?php if ($image = $project->image()): ?>
										<?= $image->name() === 'example' ? $image : img($image, [
											'alt' => '',
											'src' => [
												'width' => 702
											],
											// sizes generated with https://ausi.github.io/respimagelint/
											'sizes' => '(min-width: 1520px) 352px, (min-width: 1160px) calc(27.35vw - 58px), (min-width: 640px) calc(33.4vw - 97px), (min-width: 480px) calc(100vw - 96px), 90vw',
											'srcset' => [
												352,
												550,
												702,
												1100,
											]
										]) ?>
									<?php endif ?>
								</div>
								<figcaption class="font-mono text-sm mb-3">
									<h3 class="h6 truncate link">
										<?= $project->title() ?>
									</h3>
									<?php if ($project->info()->isNotEmpty()): ?>
									<p class="color-gray-600">
										<?= $project->info() ?>
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
<?php if (($plugins = $page->plugins()) && $plugins->count() > 0): ?>
	<div class="text-lg mb-24">
		<h2 class="h2 mb-12"><?= ucfirst($page->my()) ?> Kirby Plugins</h2>
		<section class="mb-12">
		<?php if ($plugins->count() === 1 || $plugins->count() === 4): ?>
			<?php snippet('templates/partners/plugin-hero', [
				'plugins' => $hero = $plugins->limit(1)
			]) ?>
		<?php endif ?>
		<?php snippet('templates/partners/plugin-cards', [
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
				<?= icon('bolt') ?> Visit <?= $page->my() ?> plugins page
			</a>
		</footer>
	</div>
<?php endif ?>

<?php if ($page->isCertified()) snippet('templates/partners/info-dialog') ?>
