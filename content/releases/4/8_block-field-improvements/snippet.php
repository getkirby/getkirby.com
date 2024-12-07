<style>
.v4-block-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
}
.v4-block-columns + .v4-block-columns {
	margin-top: var(--spacing-6);
}

@media screen and (min-width: 60rem) {
	.v4-block-columns {
		grid-template-columns: 1fr 1fr;
	}
}

@media screen and (min-width: 80rem) {
	.v4-block-columns {
		grid-template-columns: 3fr 2fr;
	}
	.v4-block-columns.equal {
		grid-template-columns: 1fr 1fr;
	}
	.v4-block-columns.reverse {
		grid-template-columns: 2fr 3fr;
	}
}
</style>

<div class="v4-block-columns">
	<figure class="release-padded-box bg-light grid place-items-center v4-block-columns-main">
		<?php snippet('templates/release-4/image', [
			'alt' => 'The new field preview for blocks lets you edit block content directly in form fields instead of a live block preview',
			'img' => $section->image('field-preview.png')->resize(1400)
		]) ?>
	</figure>
	<div class="release-code-box p-6 flex-grow bg-light">
		<?= $section->fieldPreviewExample()->kt() ?>
	</div>
</div>

<div class="v4-block-columns equal">
	<figure class="release-padded-box bg-light">
		<h3 class="mb-6">Display and edit headings level inline</h3>
		<?php snippet('templates/release-4/image', [
			'alt' => 'The heading level is now displayed right next to the heading and can be used to change the level on the fly',
			'img' => $section->image('heading-level.png')->resize(1000)
		]) ?>
	</figure>
	<figure class="release-padded-box bg-light">
		<h3 class="mb-6">New toggles inside the drawer</h3>
		<?php snippet('templates/release-4/image', [
			'alt' => 'The heading level can also be set with the new toggles in the block drawer',
			'img' => $section->image('heading-level-toggles.png')->resize(1000)
		]) ?>
	</figure>
</div>

<div class="v4-block-columns reverse">
	<div class="release-text-box prose text-base">
		<h3 class="mb-6">Block splitting</h3>
		<?= $section->splitting()->kt() ?>
		<p><a href="<?= $section->url() ?>">Read more …</a></p>
	</div>

	<figure class="release-padded-box bg-dark color-white grid place-items-center">
		<video controls autoplay muted class="rounded shadow-xl" style="width: 100%; --span: 2">
			<source src="<?= $section->file('splitting.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>
</div>

<div class="v4-block-columns">
	<figure class="release-padded-box bg-light" style="--span: 7; padding-bottom: 0;">
		<h3 class="mb-6">Minimized blocks while dragging</h3>
		<?php snippet('templates/release-4/image', [
			'alt' => 'Blocks are now minimized while you drag them around. This makes it easier to sort blocks with long content.',
			'img' => $section->image('collapse.png')->resize(1400)
		]) ?>
	</figure>

	<figure class="release-padded-box bg-light" style="--span: 5">
		<h3 class="mb-6">New Keyboard shortcuts</h3>
		<div class="prose text-base">
			<?= $section->shortcuts()->kt() ?>
		</div>
	</figure>
</div>
