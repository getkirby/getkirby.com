<style>
.v4-model-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"teaser"
		"code"
}

@media screen and (min-width: 55rem) {
	.v4-model-columns {
		grid-template-columns: 2fr 1fr;
		grid-template-areas:
			"code teaser"
		;
	}
}
</style>

<div class="v4-model-columns">
	<div class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</div>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
