<style>
.v5-dark-mode {
	width: 100vw;
	margin-left: 50%;
	transform: translate3d(-50%, 0, 0);
	background: var(--color-dark);
	padding-block: var(--spacing-24);
	margin-top: calc(-1 * var(--spacing-24));
	margin-bottom: var(--spacing-24);
	color: var(--color-white);
}

.v5-dark-mode-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"screen1"
		"dropdown"
		"screen2"
}

@media screen and (min-width: 40rem) {
	.v5-dark-mode-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-areas:
			"screen1 screen1"
			"teaser dropdown"
			"screen2 screen2"
	}
}

@media screen and (min-width: 80rem) {
	.v5-dark-mode-columns {
		grid-template-columns: 1fr 1fr 1fr;
		grid-template-rows: 1fr auto;
		grid-template-areas:
			"screen1 screen1 teaser"
			"dropdown screen2 screen2"
	}
}

.v5-dark-mode-teaser {
	background: var(--color-black);
	color: var(--color-white)
}
.v5-dark-mode-teaser a {
	color: var(--color-white)
}
.v5-dark-mode figure img {
	box-shadow: var(--shadow-xl);
	border-radius: .5rem;
}
</style>

<section id="<?= $section->slug() ?>" class="v5-dark-mode">
	<div class="container">
		<?php snippet('hgroup', [
			'title'    => $section->title(),
			'subtitle' => $section->subtitle(),
			'mb'       => 6
		]) ?>

		<div class="v5-dark-mode-columns">
			<figure class="release-box" style="grid-area: screen1">
				<?= $section->image('dark-mode1.png')->resize(1400) ?>
			</figure>
			<figure class="release-box" style="grid-area: screen2">
				<?= $section->image('dark-mode2.png')->resize(1400) ?>
			</figure>
			<div class="v5-dark-mode-teaser release-text-box" style="grid-area: teaser">
				<?php snippet('templates/release-40/teaser', ['section' => $section]) ?>
			</div>
			<figure class="release-box" style="grid-area: dropdown">
				<?= $section->image('dark-mode-dropdown.png')->resize(700) ?>
			</figure>
		</div>

	</div>
</section>
