<style>
.v6-errors-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"trace"
		"request"
		"validation";
}

@media screen and (min-width: 64rem) {
	.v6-errors-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-areas:
			"teaser teaser"
			"trace request"
			"validation validation";
	}
}
</style>

<div class="v6-errors-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: trace">
		<?= img($section->image('image 1.png'), [
			'alt' => 'Panel error trace view with a stack trace',
			'src' => [
				'width' => 640
			],
			'lazy' => true
		]) ?>
	</figure>
	<figure class="release-box bg-light" style="grid-area: request">
		<?= img($section->image('image 2.png'), [
			'alt' => 'Request error dialog with detailed response information',
			'src' => [
				'width' => 640
			],
			'lazy' => true
		]) ?>
	</figure>
	<figure class="release-box bg-light" style="grid-area: validation">
		<?= img($section->image('image 3.png'), [
			'alt' => 'Validation error dialog with structured field issues',
			'src' => [
				'width' => 900
			],
			'lazy' => true
		]) ?>
	</figure>
</div>
