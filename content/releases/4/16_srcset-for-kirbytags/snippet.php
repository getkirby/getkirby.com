<style>
.v4-srcset-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas:
		"teaser"
		"example-a"
		"example-b"
}

@media screen and (min-width: 55rem) {
	.v4-srcset-columns {
		grid-template-columns: 1fr 2fr;
		grid-template-areas:
			"teaser example-a"
			"teaser example-b"
		;
	}
}
</style>

<div class="v4-srcset-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-text-box" style="grid-area: example-a">
		<h3 class="mb-3">With absolute sizes</h3>
		<div class="text-lg">
			<?= $section->example1()->kt() ?>
		</div>
	</div>
	<div class="release-text-box" style="grid-area: example-b">
		<h3 class="mb-3">With predefined srcset</h3>
		<div class="text-lg">
			<?= $section->example2()->kt() ?>
		</div>
	</div>
</div>
