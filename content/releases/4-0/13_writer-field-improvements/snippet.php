<div class="columns" style="--columns: 12">
	<div class="release-text-box" style="--span: 4">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-padded-box bg-light" style="--span: 8">
		<?= $section->image('writer.png') ?>
	</div>
	<div class="release-box bg-light" style="--span: 8">
		<?= $section->image('internal-links.png') ?>
	</div>
	<div class="release-text-box" style="--span: 4">
		<div class="prose text-lg">
			<p>Link to internal pages & files with our new link field in the link dialog. No more guessing of URLs.</p>
		</div>
	</div>
	<div class="release-code-box text-lg" style="--span: 3">
		<?= $section->toolbarExample()->kt() ?>
	</div>
	<div class="release-code-box text-lg" style="--span: 3">
		<?= $section->headingsExample()->kt() ?>
	</div>
	<div class="release-code-box text-lg" style="--span: 3">
		<?= $section->subsupExample()->kt() ?>
	</div>
	<div class="release-code-box text-lg" style="--span: 3">
		<?= $section->lengthExample()->kt() ?>
	</div>
	<div class="release-text-box" style="--span: 6">
		<div class="prose text-lg">
			<?= $section->pluginTeaser()->kt() ?>
			<p><a href="<?= $section->url() ?>">Read more …</a></p>
		</div>
	</div>
	<div class="release-code-box text-lg" style="--span: 6">
		<?= $section->pluginExample()->kt() ?>
	</div>
</div>
