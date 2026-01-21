<style>
.v6-preview-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"video"
		"teaser";
}

@media screen and (min-width: 80rem) {
	.v6-preview-columns {
		grid-template-columns: 3fr 1fr;
		grid-template-areas:
			"video teaser";
	}
}
</style>

<div class="v6-preview-columns">
	<figure class="release-box bg-light grid place-items-center" style="grid-area: video">
		<video controls playsinline muted loop preload="metadata" class="rounded shadow-xl" style="width: 100%">
			<source src="<?= $section->file('live-preview.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>

	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
