<div class="columns" style="--columns: 5">
	<figure class="release-box bg-light" style="--span:5">
		<?php snippet('templates/release-4/image', [
			'alt' => 'An example for a shop with filtered products by price range',
			'img' => $section->image('section-filters.png')->resize(1800)
		]) ?>
	</figure>
	<div class="release-text-box" style="--span: 2">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-code-box text-lg" style="--span: 3">
		<?= $section->example()->kt() ?>
	</figure>
</div>
