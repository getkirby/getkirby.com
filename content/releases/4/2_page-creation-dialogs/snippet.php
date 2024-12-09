<style>
.v4-create-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"dialog"
		"code"
}

@media screen and (min-width: 40rem) {
	.v4-create-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-areas:
			"dialog dialog"
			"teaser code"
	}
}

@media screen and (min-width: 80rem) {
	.v4-create-columns {
		grid-template-columns: 3fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"dialog teaser"
			"dialog code"
	}
}
</style>

<div class="v4-create-columns">
	<figure class="release-box bg-light shadow-xl" style="grid-area: dialog">
		<?= $section->image('page-creation-dialog.png')->resize(1400) ?>
	</figure>
	<div class="v4-create-teaser release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</figure>
</div>
