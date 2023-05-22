<div class="columns" style="--columns: 4">
	<div class="release-text-box flex-grow" style="grid-row: span 2">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-text-box flex-grow" style="--span: 3">
		<h3 class="mb-3">With absolute sizes</h3>
		<div class="text-lg">
			<?= $section->example1()->kt() ?>
		</div>
	</div>
	<div class="release-text-box flex-grow" style="--span: 3">
		<h3 class="mb-3">With predefined srcset</h3>
		<div class="text-lg">
			<?= $section->example2()->kt() ?>
		</div>
	</div>
</div>
