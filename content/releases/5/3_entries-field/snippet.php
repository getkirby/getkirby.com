<style>
.v5-entries-columns {
	--columns: 1;
}

@media screen and (min-width: 50rem) {
	.v5-entries-columns {
		--columns: 2;
	}
	.v5-entries-code {
		grid-row: 1;
		grid-column: 2;
	}
	.v5-entries-hero {
		grid-column: span 3;
		grid-row: span 2;
	}
}

@media screen and (min-width: 80rem) {
	.v5-entries-columns {
		--columns: 3;
	}
	.v5-entries-code {
		grid-column: 1;
		grid-row: span 2;
	}
	.v5-entries-hero {
		grid-column: span 2;
		grid-row: span 3;
	}
}

</style>

<div class="v5-entries-columns columns">
	<div class="release-text-box">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="v5-entries-hero release-padded-box bg-light grid place-items-center">
		<?php snippet('templates/release-4/image', [
			'alt' => 'The new entries field allows you to create and manage multiple entries for the same field type',
			'img' => $section->image('entries-field.png')->resize(1500)
		]) ?>
	</figure>
	<figure class="v5-entries-code release-code-box text-lg">
		<?= $section->example()->kt() ?>
	</figure>
</div>
