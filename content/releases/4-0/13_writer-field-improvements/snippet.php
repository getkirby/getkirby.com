<div class="columns mb-6" style="--columns: 12">
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
</div>
<div class="columns mb-6" style="--columns: 4; --columns-md: 2">
	<div class="release-code-box text-lg">
		<?= $section->toolbarExample()->kt() ?>
	</div>
	<div class="release-code-box text-lg">
		<?= $section->headingsExample()->kt() ?>
	</div>
	<div class="release-code-box text-lg">
		<?= $section->subsupExample()->kt() ?>
	</div>
	<div class="release-code-box text-lg">
		<?= $section->lengthExample()->kt() ?>
	</div>
</div>
<div class="columns" style="--columns: 2">
	<div class="release-text-box">
		<div class="prose text-lg">
			<?= $section->pluginTeaser()->kt() ?>
			<p><a href="<?= $section->url() ?>">Read more …</a></p>
		</div>
	</div>
	<div class="release-code-box text-lg">
		<?= $section->pluginExample()->kt() ?>
	</div>
</div>
