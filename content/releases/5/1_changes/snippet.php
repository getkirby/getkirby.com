<style>
.v5-unsaved-changes {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
	    "preview"
		"teaser"
		"dropdown"
		"dialog"
		"filesystem"
}

@media screen and (min-width: 52rem) {
	.v5-unsaved-changes {
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"preview preview preview preview preview"
			"teaser teaser teaser dropdown dropdown"
			"dialog dialog filesystem filesystem filesystem"
	}
}
</style>

<div class="v5-unsaved-changes">
	<figure class="release-box bg-light grid place-items-center" style="grid-area: preview">
		<video autoplay playsinline muted loop class="rounded shadow-xl" style="width: 100%; --span: 2" poster="<?= $section->image('changes-poster.jpg')->url() ?>">
			<source src="<?= $section->file('changes.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: dropdown">
		<?= img($section->image('changes-info-dropdown.png'), [
			'alt' => 'A screenshot of the info dropdown for unsaved changes, showing the current editor, modification timestamp and a preview button',
			'src' => [
				'width' => 485
			],
			'lazy' => false,
			// sizes generated with https://ausi.github.io/respimagelint/
			'sizes' => '(min-width: 1520px) 485px, (min-width: 1160px) 32.94vw, (min-width: 840px) calc(40vw - 53px), (min-width: 480px) calc(100vw - 96px), 90vw',
			'srcset' => [
				485,
				740
			]
		]) ?>
	</figure>
	<figure class="release-box bg-light" style="grid-area: dialog">
		<?= img($section->image('changes-dialog.png'), [
			'alt' => 'A screenshot of the changes dialog with all unsaved pages, files and accounts',
			'src' => [
				'width' => 485
			],
			'lazy' => false,
			// sizes generated with https://ausi.github.io/respimagelint/
			'sizes' => '(min-width: 1520px) 485px, (min-width: 1160px) 32.94vw, (min-width: 840px) calc(40vw - 53px), (min-width: 480px) calc(100vw - 96px), 90vw',
			'srcset' => [
				485,
				740,
				970,
				1174,
			]
		]) ?>
	</figure>
	<figure class="release-code-box" style="grid-area: filesystem">
		<?= $section->filesystem()->kt() ?>
	</figure>
</div>
