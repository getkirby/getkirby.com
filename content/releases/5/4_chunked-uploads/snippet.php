<style>
.v5-uploads-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"video"
		"teaser"
}

@media screen and (min-width: 80rem) {
	.v5-uploads-columns {
		grid-template-columns: 3fr 1fr;
		grid-template-areas:
			"video teaser"
	}
}
</style>

<div class="v5-uploads-columns">
	<figure class="release-box bg-light grid place-items-center" style="grid-area: video">
		<video controls muted loop class="rounded shadow-xl" style="width: 100%; --span: 2">
			<source src="<?= $section->file('chunked.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>


	<div class="v5-uploads-teaser release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
