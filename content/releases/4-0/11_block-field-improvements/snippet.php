<div class="columns" style="--columns: 12">
	<figure class="release-padded-box bg-light" style="--span: 8">
		<?= $section->image('field-preview.png') ?>
	</figure>
	<div class="release-code-box p-6 flex-grow bg-light" style="--span: 4">
		<?= $section->fieldPreviewExample()->kt() ?>
	</div>

	<figure class="release-padded-box bg-light" style="--span: 6">
		<h3 class="mb-6">Display and edit headings level inline</h3>
		<?= $section->image('heading-level.png') ?>
	</figure>
	<figure class="release-padded-box bg-light" style="--span: 6">
		<h3 class="mb-6">New toggles inside the drawer</h3>
		<?= $section->image('heading-level-toggles.png') ?>
	</figure>

	<figure class="release-padded-box bg-light" style="--span: 6">
		<h3 class="mb-6">New Keyboard shortcuts</h3>
		<div class="prose text-base">
			<?= $section->shortcuts()->kt() ?>
		</div>
	</figure>

	<figure class="release-padded-box bg-light" style="--span: 6; padding-bottom: 0;">
		<h3 class="mb-6">Minimized blocks while dragging</h3>
		<?= $section->image('collapse.png') ?>
	</figure>

	<figure class="release-padded-box bg-dark color-white" style="--span: 12">
		<h3 class="mb-6">Block splitting</h3>
		<video controls class="rounded shadow-xl" style="width: 100%;">
			<source src="<?= $section->file('splitting-1.mp4')->url() ?>" type="video/mp4" autoplay>
		</video>
	</figure>

</div>
