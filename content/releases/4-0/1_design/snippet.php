<div class="columns" style="--columns: 2">
	<figure class="release-box bg-light shadow-xl" style="--span: 2">
		<?= $section->image('company.png')->resize(1600) ?>
	</figure>

	<div class="release-text-box prose text-base">
		<h3 class="mb-6">Editor features</h3>
		<?= $section->editors()->kt() ?>
	</div>
	<div class="release-text-box prose text-base">
		<h3 class="mb-6">Developer features</h3>
		<?= $section->developers()->kt() ?>
	</div>
</div>
