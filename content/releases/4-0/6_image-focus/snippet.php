<style>
.v4-focus-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"figure"
		"teaser";
}

@media screen and (min-width: 80rem) {
	.v4-focus-columns {
		grid-template-columns: 1fr 3fr;
		grid-template-areas: "teaser figure";
	}
}
</style>

<div class="v4-focus-columns">
	<figure class="release-box bg-light shadow-xl" style="grid-area: figure">
		<?= $section->image('image-focus.png') ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
</div>
