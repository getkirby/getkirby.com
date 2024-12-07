<style>
.v5-plugin-license {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"plugin"
		"view"
}

@media screen and (min-width: 32rem) {
	.v5-plugin-license {
		grid-template-columns: 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"teaser plugin"
			"view view"
	}
}
</style>

<div class="v5-plugin-license">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-code-box" style="grid-area: plugin">
		<?= $section->plugin()->kt() ?>
	</figure>
	<figure class="release-box bg-light" style="grid-area: view">
		<?= $section->image('plugin-licenses.png')->resize(1400) ?>
	</figure>
</div>
