<style>
.v4-color-columns {
	--columns: 1;
}

@media screen and (min-width: 50rem) {
	.v4-color-columns {
		--columns: 2;
	}
	.v4-color-code {
		grid-column: 2;
	}
	.v4-color-modes {
		grid-row: 2;
		grid-column: 1;
	}
}

@media screen and (min-width: 80rem) {
	.v4-color-columns {
		--columns: 3;
	}
	.v4-color-code {
		grid-column: 1;
	}
	.v4-color-hero {
		grid-column: span 2;
		grid-row: span 3;
	}
}

</style>

<div class="v4-color-columns columns">
	<div class="release-text-box">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="v4-color-hero release-padded-box bg-light grid place-items-center">
		<?php snippet('templates/release-4/image', [
			'alt' => 'The new color field with the color picker dropdown and predefined colors with names',
			'img' => $section->image('color-field.png')->resize(850)
		]) ?>
	</figure>
	<figure class="v4-color-code release-code-box text-lg">
		<?= $section->example()->kt() ?>
	</figure>
	<figure class="v4-color-modes release-box bg-light flex-grow grid place-items-center p-6">
		<?php snippet('templates/release-4/image', [
			'alt' => 'The color field can be simplified to show a set of predefined colors instead of offering a color picker',
			'img' => $section->image('color-field-modes.png')->resize(470)
		]) ?>
	</figure>
</div>
