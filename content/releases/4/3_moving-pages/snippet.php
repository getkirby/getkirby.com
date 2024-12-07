<style>
.v4-move-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"dialog"
		"teaser"
		"dropdown"
}

@media screen and (min-width: 32rem) {
	.v4-move-columns {
		grid-template-columns: 2fr 3fr;
		grid-template-rows: 1fr auto;
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
	<figure class="v4-move-hero release-box bg-black shadow-xl" style="grid-area: dialog">
		<?php snippet('templates/release-4/image', [
			'alt' => 'A new parent for the page can be picked with our brand new page tree dialog',
			'img' => $section->image('move-dialog.png')->resize(1400)
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="v4-move-dropdown release-padded-box bg-light" style="grid-area: dropdown">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'The page dropdowns have been extended with the new Move page option',
			'img'   => $section->image('move-dropdown.png')->resize(330),
			'class' => 'shadow-xl'
		]) ?>
	</figure>
</div>
