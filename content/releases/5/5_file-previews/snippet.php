<div class="columns" style="--columns: 5">
	<figure class="release-box bg-light grid place-items-center" style="--span: 5">
		<video controls playsinline muted loop preload="metadata" class="rounded shadow-xl" style="width: 100%" poster="<?= $section->image('file-previews-poster.jpg')->url() ?>">
			<source src="<?= $section->file('file-previews.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>
	<div class="release-text-box" style="--span: 2">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-code-box text-lg" style="--span: 3">
		<?= $section->class()->kt() ?>
	</figure>
</div>
