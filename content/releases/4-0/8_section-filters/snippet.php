<div class="columns" style="--columns: 4">
	<div style="--span: 3">
		<figure class="release-box bg-light shadow-xl mb-6">
			<?= $section->image('section-filters.png') ?>
		</figure>
		<figure class="release-code-box" style="--span: 3">
			<?= $section->example()->kt() ?>
		</figure>
	</div>
	<div class="flex flex-column">
		<div class="release-padded-box flex-grow bg-light">
			<?= $section->teaser()->kt() ?>
		</div>
	</div>
</div>
