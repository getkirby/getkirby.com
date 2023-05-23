<style>
.v4-move-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"dialog"
		"teaser"
		"dropdown"
}
.v4-move-dropdown {
	padding: 10%;
}

@media screen and (min-width: 32rem) {
	.v4-move-columns {
		grid-template-columns: 2fr 3fr;
		grid-template-areas:
			"dialog dialog"
			"dropdown teaser"
	}
}

@media screen and (min-width: 70rem) {
	.v4-move-columns {
		grid-template-columns: 1fr 3fr;
		grid-template-areas:
			"teaser dialog"
			"dropdown dialog"
	}
	.v4-move-hero > * {
		position: inset;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
}
</style>

<div class="v4-move-columns">
	<figure class="v4-move-hero release-box bg-light shadow-xl" style="grid-area: dialog">
		<?= $section->image('move-dialog.png') ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
	<figure class="v4-move-dropdown release-box bg-light" style="grid-area: dropdown">
		<img src="<?= $section->image('dropdown.png')->url() ?>" class="shadow-xl">
	</figure>
</div>
