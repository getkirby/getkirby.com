<style>
.v4-writer-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
}

@media screen and (min-width: 60rem) {
	.v4-writer-columns {
		grid-template-columns: 1fr 1fr;
	}
}

@media screen and (min-width: 70rem) {
	.v4-writer-columns {
		grid-template-columns: 2fr 1fr;
	}
	.v4-writer-columns.reverse {
		grid-template-columns: 1fr 2fr;
	}
}

@media screen and (min-width: 80rem) {
	.v4-writer-columns {
		grid-template-columns: 3fr 1fr;
	}
	.v4-writer-columns.reverse {
		grid-template-columns: 1fr 3fr;
	}
}
</style>

<div class="v4-writer-columns reverse mb-6">
	<div class="release-text-box">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-padded-box bg-light" style="--span: 8">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'The updated writer field with the new toolbar option that resembles the fixed toolbar of the textarea',
			'img'   => $section->image('writer.png')->resize(1600),
		]) ?>
	</div>
</div>
<div class="v4-writer-columns mb-6">
	<div class="release-box bg-light" style="--span: 8">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'The link picker for the writer now also features the new link field',
			'img'   => $section->image('internal-links.png')->resize(1600),
		]) ?>
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
			<p><a href="<?= $section->pluginLink() ?>">Read more …</a></p>
		</div>
	</div>
	<div class="release-code-box text-lg">
		<?= $section->pluginExample()->kt() ?>
	</div>
</div>
