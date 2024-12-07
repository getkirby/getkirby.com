<style>
.v4-file-template-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"view"
		"teaser"
}

@media screen and (min-width: 60rem) {
	.v4-file-template-columns {
		grid-template-columns: 1fr 2fr;
		grid-template-areas:
			"teaser view"
		;
	}
}
</style>

<div class="v4-file-template-columns">
	<figure class="release-box bg-light" style="grid-area: view">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'The new dialog to change the template of a file.',
			'img'   => $section->image('change-template.png')->resize(1600),
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
