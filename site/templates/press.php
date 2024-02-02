<?php layout() ?>

<style>
#logo svg {
	width: 100%;
	height: 42px;
}
</style>

<article>
	<header class="max-w-xl mb-24">
		<h1 class="h1 mb-12">Download logos and screenshots for use in digital and print media</h1>
		<a class="btn btn--filled" href="<?= $page->file('kirby-presskit.zip')->url() ?>" download>
			<?= icon('download') ?> Download the press kit
		</a>
	</header>
	<section id="logo" class="mb-24">
		<h2 class="h2 mb-6">Logo</h2>
		<ul class="columns" style="--columns: 2; --gap: var(--spacing-12)">
			<?php foreach ($page->images()->filterBy('extension', 'svg') as $logo): ?>
			<li>
				<a href="<?= $logo->url() ?>" download>
					<figure>
						<p class="block p-6 mb-3 bg-light rounded"><?= $logo->read() ?></p>
						<figcaption class="h6">
							<?= $logo->filename() ?>
							<small class="color-gray-700"><?= $logo->niceSize() ?></small>
						</figcaption>
					</figure>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
	<section id="screenshots">
		<h2 class="h2 mb-6">Screenshots</h2>
		<ul class="columns" style="--columns: 2; --gap: var(--spacing-12)">
			<?php foreach ($page->images()->filterBy('extension', 'png') as $screenshot): ?>
			<li>
				<a aria-label="Download the Panel screenshot" class="block bg-light rounded overflow-hidden" href="<?= $screenshot->url() ?>" style="--aspect-ratio: <?= $screenshot->width() . '/' . $screenshot->height() ?>" download>
					<?= img($screenshot, [
						'alt' => 'A panel screenshot',
						'class' => 'shadow-2xl',
						'src' => [
							'width'  => 1000,
						],
						'srcset' => [
							'1x' => [
								'width'  => 1000
							],
							'2x' => [
								'width'  => 1500
							],
						]
					]) ?>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
</article>
