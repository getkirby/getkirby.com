<style>
.v5-unsaved-changes {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
	    "preview"
		"teaser"
		"dropdown"
		"dialog"
		"filesystem"
}

@media screen and (min-width: 52rem) {
	.v5-unsaved-changes {
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"preview preview preview preview preview"
			"teaser teaser teaser dropdown dropdown"
			"dialog dialog filesystem filesystem filesystem"
	}
}
</style>

<div class="v5-unsaved-changes">
	<figure class="release-box bg-light grid place-items-center" style="grid-area: preview">
		<video autoplay muted loop class="rounded shadow-xl" style="width: 100%; --span: 2">
			<source src="<?= $section->file('changes.mp4')->url() ?>" type="video/mp4">
		</video>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: dropdown">
		<?= $section->image('changes-info-dropdown.png')->resize(700) ?>
	</figure>
	<figure class="release-box bg-light" style="grid-area: dialog">
		<?= $section->image('changes-dialog.png')->resize(700) ?>
	</figure>
	<figure class="release-code-box" style="grid-area: filesystem">
		<?= $section->filesystem()->kt() ?>
	</figure>
</div>
