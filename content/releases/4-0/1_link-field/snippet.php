<div class="columns" style="--columns: 3">
	<figure class="release-padded-box bg-light flex items-center" style="--span: 2">
		<?= $section->image('file-link.png') ?>
	</figure>
	<div class="columns" style="--columns: 1">
		<div class="release-text-box flex-grow">
			<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
		</div>
		<figure class="release-padded-box bg-light flex" style="align-items: flex-end; padding-right: 0; padding-bottom: 0">
			<?= $section->image('link-types.png') ?>
		</figure>
		<figure class="release-code-box text-lg">
			<?= $section->example()->kt() ?>
		</figure>
	</div>
</div>
