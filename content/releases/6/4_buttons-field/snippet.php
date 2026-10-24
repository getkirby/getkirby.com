<style>
.v6-buttons-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"image";
}

@media screen and (min-width: 64rem) {
	.v6-buttons-columns {
		grid-template-columns: 2fr 1fr;
		grid-template-areas:
			"image teaser";
	}
}
</style>

<div class="v6-buttons-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-dark p-12" style="grid-area: image">
		<?= img($section->image('image.webp'), [
			'alt' => 'A Panel form showing the new buttons field with multiple actions',
			'src' => [
				'width' => 760
			],
			'class' => 'shadow-xl rounded',
			'lazy' => true,
			'srcset' => [
				400,
				760,
				1200
			]
		]) ?>
	</figure>
</div>
