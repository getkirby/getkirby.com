<style>
.v6-preview-columns .prose {
	color: var(--color-gray-400);
}
.v6-preview-columns .prose a {
	color: var(--color-gray-200);
}

</style>

<div class="v6-preview-columns flex flex-column" style="gap: var(--spacing-6)">
	<figure class="release-box bg-dark p-12">
		<video controls playsinline muted loop preload="metadata" class="rounded shadow-xl mb-6" style="width: 100%" poster="<?= $section->image('live-preview-poster.jpg')->url() ?>">
			<source src="<?= $section->file('live-preview.mp4')->url() ?>" type="video/mp4">
		</video>
		<figcaption>
			<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
		</figcaption>
	</figure>
</div>
