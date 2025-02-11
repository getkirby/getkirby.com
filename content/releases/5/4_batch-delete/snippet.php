<style>
.v5-batch-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"screenshot"
		"teaser"
		"code"
}

@media screen and (min-width: 80rem) {
	.v5-batch-columns {
		grid-template-columns: 1fr 2fr 1fr;
		grid-template-areas:
			"teaser screenshot code"
	}
}
</style>

<div class="v5-batch-columns">
	<div class="v5-uploads-teaser release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light grid place-items-center" style="grid-area: screenshot">
		<?php snippet('templates/release-4/image', [
			'alt' => 'A screenshot of the fields section. Batch selection mode has been activated and multiple files are selected. A delete button at the top can delete all the selected files at once.',
			'img' => $section->image('batch-delete.jpg')->resize(850)
		]) ?>
	</figure>
	<figure class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</figure>
</div>
