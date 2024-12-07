<style>
.v4-link-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"teaser"
		"hero"
		"code"
		"dropdown"
}
.v4-link-dropdown {
	display: flex;
	align-items: flex-end;
	padding-right: 0;
	padding-bottom: 0;
}

@media screen and (min-width: 40rem) {
	.v4-link-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-areas:
			"hero hero"
			"teaser dropdown"
			"code dropdown"
	}
}

@media screen and (min-width: 60rem) {
	.v4-link-columns {
		grid-template-columns: 2fr 1fr;
		grid-template-areas:
			"hero teaser"
			"hero code"
			"hero dropdown"
	}
}
</style>


<div class="v4-link-columns">
	<div class="v4-link-teaser release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="v4-link-hero release-padded-box bg-light flex items-center" style="grid-area: hero">
		<?php snippet('templates/release-4/image', [
			'alt' => 'Our new link field with the new file browser',
			'img' => $section->image('file-link.png')->resize(1200)
		]) ?>
	</figure>
	<figure class="v4-link-code release-code-box text-lg" style="grid-area: code">
		<?= $section->example()->kt() ?>
	</figure>
	<figure class="v4-link-dropdown release-padded-box bg-light" style="grid-area: dropdown">
		<?php snippet('templates/release-4/image', [
			'alt' => 'Dropdown with all available link types (URL, Page, File, Email and Phone Number)',
			'img' => $section->image('link-types.png')
		]) ?>
	</figure>
</div>
