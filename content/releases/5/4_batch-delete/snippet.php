<style>
.v5-batch-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"screenshot"
		"teaser"
		"code"
}

@media screen and (min-width: 80rem) {
	.v5-batch-columns {
		grid-template-columns: 1fr 2fr 1fr;
		grid-template-areas:
			"teaser screenshot code"
	}
}
</style>

<div class="v5-batch-columns">
	<div class="v5-uploads-teaser release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light grid place-items-center" style="grid-area: screenshot">
		<?= img($section->image('batch-delete.jpg'), [
			'alt' => 'A screenshot of the fields section. Batch selection mode has been activated and multiple files are selected. A delete button at the top can delete all the selected files at once.',
			'src' => [
				'width' => 520
			],
			'lazy' => true,
			// sizes generated with https://ausi.github.io/respimagelint/
			'sizes' => '(min-width: 1540px) 600px, (min-width: 1280px) calc(33.33vw + 93px), (min-width: 1160px) calc(100vw - 192px), (min-width: 480px) calc(100vw - 96px), 90vw',
			'srcset' => [
				270,
				637,
				936,
				1200,
				1374
			]
		]) ?>
	</figure>
	<figure class="release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</figure>
</div>
