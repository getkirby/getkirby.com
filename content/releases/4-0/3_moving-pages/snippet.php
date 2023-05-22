<div class="columns" style="--columns: 4">
	<div class="columns" style="--columns: 1">
		<div class="release-text-box flex-grow">
			<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
		</div>
		<figure class="release-padded-box bg-light">
			<img src="<?= $section->image('dropdown.png')->url() ?>" class="shadow-xl">
		</figure>
	</div>
	<figure class="release-box bg-light shadow-xl" style="--span: 3">
		<?= $section->image('move-dialog.png') ?>
	</figure>
</div>
