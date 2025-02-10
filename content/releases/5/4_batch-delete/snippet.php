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
		grid-template-columns: 1fr 1fr 2fr;
		grid-template-areas:
			"teaser code screenshot"
	}
}
</style>

<div class="v5-batch-columns">
	<figure class="release-box bg-light grid place-items-center" style="grid-area: screenshot">
		<?php snippet('templates/release-4/image', [
			'alt' => '',
			'img' => $section->image('batch-delete.png')->resize(850)
		]) ?>
	</figure>
	<div class="v5-uploads-teaser release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</figure>
</div>
