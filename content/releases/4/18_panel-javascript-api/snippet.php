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
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-box shadow-xl bg-light" style="grid-area: view">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'All major Panel features can now be controlled directly from your browser console',
			'img'   => $section->image('console.png')->resize(1600),
		]) ?>
	</div>
</div>
