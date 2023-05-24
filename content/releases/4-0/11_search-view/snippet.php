<style>
.v4-search-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"view"
		"teaser"
}

@media screen and (min-width: 60rem) {
	.v4-search-columns {
		grid-template-columns: 3fr 1fr;
		grid-template-areas:
			"view teaser"
		;
	}
}
</style>

<div class="v4-search-columns">
	<figure class="release-box bg-light shadow-xl" style="grid-area: view">
		<?php snippet('templates/release-40/image', [
			'alt'   => 'The new search view with a long list of results for a file search.',
			'img'   => $section->image('search-view.png'),
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
	</div>
</div>
