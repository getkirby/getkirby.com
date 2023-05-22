<div class="columns" style="--columns: 3">
	<div class="columns" style="--columns: 1">
		<div class="release-text-box">
			<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
		</div>
		<figure class="release-box bg-light flex-grow grid place-items-center p-6">
			<?= $section->image('color-field-modes.png') ?>
		</figure>
		<figure class="release-code-box text-lg">
			<?= $section->example()->kt() ?>
		</figure>
	</div>
	<figure class="release-padded-box bg-light" style="--span: 2">
		<?= $section->image('color-field-names.png') ?>
	</figure>
</div>
