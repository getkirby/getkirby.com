<style>
.v6-stacks-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"code";
}

@media screen and (min-width: 64rem) {
	.v6-stacks-columns {
		grid-template-columns: 1fr 2fr;
		grid-template-areas:
			"teaser code";
	}
}
</style>

<div class="v6-stacks-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<div class="release-box flex flex-column" style="grid-area: code; gap: var(--spacing-6)">
		<figure class="release-code-box text-lg">
			<?= $section->header()->kt() ?>
		</figure>
		<figure class="release-code-box text-lg">
			<?= $section->body()->kt() ?>
		</figure>
		<figure class="release-code-box text-lg">
			<?= $section->footer()->kt() ?>
		</figure>
	</div>
</div>
