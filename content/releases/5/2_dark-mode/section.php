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
	background: #1f1f1f;
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
				<?= img($section->image('dark-mode-1.webp'), [
					'alt' => 'A screenshot of a Panel page overview in the new dark theme',
					'src' => [
						'width' => 824
					],
					'lazy' => true,
					// sizes generated with https://ausi.github.io/respimagelint/
					'sizes' => '(min-width: 1560px) 824px, (min-width: 1280px) calc(41.15vw + 190px), (min-width: 1160px) calc(100vw - 192px), (min-width: 480px) calc(100vw - 96px), 90vw',
					'srcset' => [
						400,
						824,
						1088,
						1200,
						1648,
						1900,
						2176
					]
				]) ?>
			</figure>
			<figure class="release-box" style="grid-area: screen2">
				<?= img($section->image('dark-mode-2.webp'), [
					'alt' => 'A screenshot of a Panel page form in the new dark theme',
					'src' => [
						'width' => 824
					],
					'lazy' => true,
					// sizes generated with https://ausi.github.io/respimagelint/
					'sizes' => '(min-width: 1560px) 824px, (min-width: 1280px) calc(41.15vw + 190px), (min-width: 1160px) calc(100vw - 192px), (min-width: 480px) calc(100vw - 96px), 90vw',
					'srcset' => [
						400,
						824,
						1088,
						1200,
						1648,
						1900,
						2176
					]
				]) ?>
			</figure>
			<div class="v5-dark-mode-teaser release-text-box" style="grid-area: teaser">
				<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
			</div>
			<figure class="release-box" style="grid-area: dropdown">
				<?= img($section->image('dark-mode-dropdown.webp'), [
					'alt' => 'A screenshot of the theme dropdown in the user settings showing options for lights on, lights off and match system default',
					'src' => [
						'width' => 400
					],
					'lazy' => true,
					// sizes generated with https://ausi.github.io/respimagelint/
					'sizes' => '(min-width: 1540px) 400px, (min-width: 1280px) calc(22.08vw + 64px), (min-width: 1160px) calc(50vw - 108px), (min-width: 640px) calc(50vw - 60px), (min-width: 480px) calc(100vw - 96px), 90vw',
					'srcset' => [
						400,
						800
					]
				]) ?>
			</figure>
		</div>

	</div>
</section>
