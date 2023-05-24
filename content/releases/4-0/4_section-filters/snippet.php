<div class="columns" style="--columns: 5">
	<figure class="release-box bg-light" style="--span:5">
		<?= $section->image('section-filters.png') ?>
	</figure>
	<div class="release-text-box" style="--span: 2">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-code-box text-lg" style="--span: 3">
		<?= $section->example()->kt() ?>
	</figure>
</div>
