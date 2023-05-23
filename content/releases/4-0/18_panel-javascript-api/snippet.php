<style>
.v4-panel-js-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"view"
		"teaser"
}

@media screen and (min-width: 65rem) {
	.v4-panel-js-columns {
		grid-template-columns: 1fr 2fr;
		grid-template-areas:
			"teaser view"
		;
	}
}

@media screen and (min-width: 75rem) {
	.v4-panel-js-columns {
		grid-template-columns: 1fr 3fr;
	}
}
</style>

<div class="v4-panel-js-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-box shadow-xl bg-light" style="grid-area: view">
		<?= $section->image('console.png') ?>
	</div>
</div>
