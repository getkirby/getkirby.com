<section id="image-options" class="mb-42">
	<div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
		<div>
			<?php snippet('templates/features/intro', [
				'title' => 'Image options',
				'intro' => 'Improve your previews with custom queries',
				'text'  => 'You can now set custom backgrounds, icons, images and more for your pages via blueprint settings. Per page, not just per section.'
			]) ?>
			<?= $page->imageOptions()->kt() ?>
		</div>
		<figure>
			<?= img('image-options.png', [
				'alt' => 'A list with pages with custom colors and icons for previews in the panel',
				'lightbox' => true,
				'class' => 'rounded shadow-xl',
				'src' => [
					'width' => 1000,
				],
				'srcset' => [
					1000,
					2000,
				]
			]) ?>
		</figure>
	</div>
</section>
