<style>
.v5-view-buttons {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"buttons"
		"blueprint"
		"config"
}

@media screen and (min-width: 42rem) {
	.v5-view-buttons {
		grid-template-columns: 1fr 1fr;
		grid-template-rows: 1fr auto auto;
		grid-template-areas:
			"teaser teaser"
			"buttons buttons"
			"blueprint config"
	}
}

@media screen and (min-width: 64rem) {
	.v5-view-buttons {
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"teaser teaser teaser buttons buttons"
			"blueprint blueprint config config config"
	}
}
</style>

<div class="v5-view-buttons">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: buttons">
		<?= $section->image('buttons.png') ?>
	</figure>
	<figure class="release-code-box" style="grid-area: blueprint">
		<?= $section->blueprintConfig()->kt() ?>
	</figure>
	<figure class="release-code-box" style="grid-area: config">
		<?= $section->config()->kt() ?>
	</figure>
</div>
