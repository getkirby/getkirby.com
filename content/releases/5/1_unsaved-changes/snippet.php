<style>
.v5-unsaved-changes {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
	    "preview"
		"teaser"
		"dropdown"
		"dialog"
		"outlook"
}

@media screen and (min-width: 32rem) {
	.v5-unsaved-changes {
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"preview preview preview preview preview"
			"teaser teaser teaser dropdown dropdown"
			"dialog dialog outlook outlook outlook"
	}
}
</style>

<div class="v5-unsaved-changes">
	<figure class="release-box bg-light grid place-items-center" style="grid-area: preview">
		<video controls autoplay muted loop class="rounded shadow-xl" style="width: 100%; --span: 2">
			<source src="<?= $section->file('preview.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: dropdown">
		<?= $section->image('dropdown.png')->resize(700) ?>
	</figure>
	<figure class="release-box bg-light" style="grid-area: dialog">
		<?= $section->image('dialog.png')->resize(700) ?>
	</figure>
	<figure class="release-text-box" style="grid-area: outlook">
		<?= $section->filesystem()->kt() ?>
	</figure>
</div>
