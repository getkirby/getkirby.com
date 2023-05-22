<div class="columns" style="--columns: 4">
	<figure class="release-box bg-light shadow-xl" style="--span: 3">
		<?= $section->image('page-creation-dialog.png') ?>
	</figure>
	<div class="flex flex-column">
		<div class="release-text-box flex-grow mb-6">
			<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
		</div>
		<figure class="release-code-box text-lg">
			<?= $section->example()->kt() ?>
		</figure>
	</div>
</div>
