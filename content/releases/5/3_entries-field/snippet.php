<style>
.v5-entries-columns {
	--columns: 1;
}

@media screen and (min-width: 50rem) {
	.v5-entries-columns {
		--columns: 2;
	}
	.v5-entries-code {
		grid-row: 1;
		grid-column: 2;
	}
	.v5-entries-hero {
		grid-column: span 3;
		grid-row: span 2;
	}
}

@media screen and (min-width: 80rem) {
	.v5-entries-columns {
		--columns: 3;
	}
	.v5-entries-code {
		grid-column: 1;
		grid-row: span 2;
	}
	.v5-entries-hero {
		grid-column: span 2;
		grid-row: span 3;
	}
}

</style>

<div class="v5-entries-columns columns">
	<div class="release-text-box">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="v5-entries-hero release-padded-box bg-light grid place-items-center">
		<?= img($section->image('entries-field.png'), [
			'alt' => 'The new entries field allows you to create and manage multiple entries for the same field type',
			'src' => [
				'width' => 600
			],
			'lazy' => true,
			// sizes generated with https://ausi.github.io/respimagelint/
			'sizes' => '(min-width: 1540px) 760px, (min-width: 1280px) calc(44.58vw + 82px), (min-width: 1160px) calc(100vw - 256px), (min-width: 480px) calc(100vw - 160px), calc(90vw - 66px)',
			'srcset' => [
				525,
				760,
				1200,
				1500
			]
		]) ?>
	</figure>
	<figure class="v5-entries-code release-code-box text-lg">
		<?= $section->example()->kt() ?>
	</figure>
</div>
