<div class="columns" style="--columns: 4">
	<div class="release-text-box">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>

	<figure class="release-padded-box bg-dark color-white grid place-items-center" style="--span: 3; grid-row: span 2">
		<video controls class="rounded shadow-xl" style="width: 100%; --span: 2">
			<source src="<?= $section->file('change-layout-1.mp4')->url() ?>" type="video/mp4" autoplay>
		</video>
	</figure>

	<div class="release-padded-box bg-light">
		<img src="<?= $section->image('copy-and-paste-dropdown.png')->url() ?>" class="rounded shadow-xl">
	</div>
</div>
