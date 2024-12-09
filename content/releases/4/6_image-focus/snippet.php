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
		<?php snippet('templates/release-4/image', [
			'alt' => 'The focus point for images can now be set directly in the file view. Drop a marker on the most relevant point in the image to always crop around a custom center point.',
			'img' => $section->image('image-focus.png')->resize(1800)
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
</div>
