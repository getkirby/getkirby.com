<div class="columns" style="--columns: 2">
	<div class="release-text-box">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-text-box prose text-lg" style="color: black; background: var(--color-orange-300)">
		<?= $section->warning()->kt() ?>
	</div>
</div>
