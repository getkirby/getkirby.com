<style>
.v6-errors-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"request"
		"teaser"
		"validation";
}

@media screen and (min-width: 64rem) {
	.v6-errors-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"teaser request"
			"validation request";
	}
}
</style>

<div class="v6-errors-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>

	<figure class="release-box p-12 bg-dark text-lg" style="grid-area: request">
		<?= img($section->image('image 2.webp'), [
			'alt' => 'Request error dialog with detailed response information',
			'src' => [
				'width' => 640
			],
			'class' => 'shadow-xl rounded',
			'lazy' => true
		]) ?>
	</figure>

	<figure class="release-box p-12 bg-dark" style="grid-area: validation">
		<?= img($section->image('image 3.webp'), [
			'alt' => 'Validation error dialog with structured field issues',
			'src' => [
				'width' => 900
			],
			'class' => 'shadow-xl rounded',
			'lazy' => true
		]) ?>
	</figure>
</div>
