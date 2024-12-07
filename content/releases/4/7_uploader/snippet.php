<style>
.v4-uploader-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"dialog"
		"teaser"
		"code";
}

@media screen and (min-width: 40rem) {
	.v4-uploader-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-areas:
			"dialog dialog"
			"teaser code"
		;
	}
}

@media screen and (min-width: 80rem) {
	.v4-uploader-columns {
		grid-template-columns: 3fr 1fr;
		grid-template-areas:
			"dialog teaser"
			"dialog code"
		;
	}
	.v4-uploader-dialog > * {
		position: inset;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
}
</style>

<div class="v4-uploader-columns">
	<figure class="v4-uploader-dialog release-box bg-light shadow-xl" style="grid-area: dialog">
		<?php snippet('templates/release-4/image', [
			'alt' => 'The new upload dialog with four images, ready to be uploaded. Each file has a new input to change the filename before the file gets uploaded.',
			'img' => $section->image('uploader.png')->resize(1600)
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-code-box text-lg" style="grid-area: code">
		<?= $section->optimize()->kt() ?>
	</div>
</div>
