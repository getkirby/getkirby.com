<div class="columns" style="--columns: 3">
	<figure class="release-box bg-light shadow-xl" style="--span: 2; grid-row: span 2">
		<?= $section->image('uploader.png') ?>
	</figure>
	<div class="release-text-box flex-grow" style="--span: 1">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-code-box flex-grow text-lg">
		<?= $section->optimize()->kt() ?>
	</div>
</div>
