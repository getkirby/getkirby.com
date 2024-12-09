<style>
.v4-textarea-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"teaser"
		"code"
}

@media screen and (min-width: 60rem) {
	.v4-textarea-columns {
		grid-template-columns: 1fr 2fr;
		grid-template-areas:
			"teaser code"
		;
	}
}
</style>

<div class="v4-textarea-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</div>
</div>
