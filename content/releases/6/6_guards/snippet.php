<style>
.v6-guards-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"code";
}

@media screen and (min-width: 64rem) {
	.v6-guards-columns {
		grid-template-columns: 2fr 1fr;
		grid-template-areas:
			"code teaser";
	}
}
</style>

<div class="v6-guards-columns">
	<figure class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
