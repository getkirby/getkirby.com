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
		<?= img($section->image('plugin-licenses.png'), [
			'alt' => 'A screenshot of the plugin table in the system view with different license states such as custom proprietary license, demo, pay to activate and expired',
			'src' => [
				'width' => 1248
			],
			'lazy' => true,
			// sizes generated with https://ausi.github.io/respimagelint/
			'sizes' => '(min-width: 1540px) 1248px, (min-width: 1160px) calc(77.78vw + 66px), (min-width: 480px) calc(100vw - 96px), 90vw',
			'srcset' => [
				400,
				800,
				1248,
				1600,
				2092,
			]
		]) ?>
	</figure>
</div>
