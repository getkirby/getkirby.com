<style>
.v4-search-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"view"
		"teaser"
		"dialog"
}

@media screen and (min-width: 60rem) {
	.v4-search-columns {
		grid-template-columns: 2fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"view teaser"
			"view dialog"
		;
	}
}
</style>

<div class="v4-search-columns">
	<figure class="release-box bg-light shadow-xl" style="grid-area: view">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'The new search view with a long list of results for a file search.',
			'img'   => $section->image('search-view.png')->resize(1600),
		]) ?>
	</figure>
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: dialog">
		<?php snippet('templates/release-4/image', [
			'alt' => 'Dropdown with all available link types (URL, Page, File, Email and Phone Number)',
			'img' => $section->image('search-dialog.png')
		]) ?>
	</figure>
</div>
