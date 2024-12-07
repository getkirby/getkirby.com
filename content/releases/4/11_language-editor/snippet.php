<style>
.v4-language-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"view"
		"teaser"
}

@media screen and (min-width: 60rem) {
	.v4-language-columns {
		grid-template-columns: 1fr 2fr;
		grid-template-areas:
			"teaser view"
		;
	}
}
</style>

<div class="v4-language-columns">
	<figure class="release-box bg-light" style="grid-area: view">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'The new language view with general information about the language and the new language variable editor.',
			'img'   => $section->image('language.png')->resize(1600),
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
