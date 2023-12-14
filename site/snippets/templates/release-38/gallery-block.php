<style>
	.v38-gallery-block-grid {
		display: grid;
		grid-gap: var(--spacing-6);
		grid-template-areas:
			"text1"
			"figure1"
			"text2"
			"figure2"
	}

	@media screen and (min-width: 45rem) {
		.v38-gallery-block-grid {
			grid-template-columns: 1fr 1fr;
			grid-template-areas:
				"figure1 text1"
				"figure2 text2"
		}

		.v38-gallery-block-grid > figure {
			aspect-ratio: 5/4;
			padding: var(--spacing-3);
		}
	}

	@media screen and (min-width: 60rem) {
		.v38-gallery-block-grid {
			grid-template-columns: 1fr 1fr 1fr;
			grid-template-areas:
				"text1 figure1 figure1"
				"figure2 figure2 text2"
		}

		.v38-gallery-block-grid > figure {
			aspect-ratio: auto;
			padding: 0;
		}
	}
</style>

<section id="gallery-block" class="mb-42">

	<?php snippet('hgroup', [
		'title'    => 'Better gallery block',
		'subtitle' => 'Artistic control for your images',
		'mb'       => 12
	]) ?>

	<div class="v38-gallery-block-grid">
		<div class="release-text-box" style="grid-area: text1">
			<h3>Better settings</h3>
			<div class="prose">
				The gallery block features new ratio, crop and caption fields.
			</div>
		</div>

		<figure class="release-box bg-light grid place-items-center" style="grid-area: figure1">
			<img src="<?= $page->image('gallery-block-1.png')?->url() ?>" loading="lazy" alt="The card design shows the new rounded corners that have been introduced throughout the Panel" style="--aspect-ratio: 1591/1137">
		</figure>

		<div class="release-text-box" style="grid-area: text2">
			<h3>Better preview</h3>
			<div class="prose">
				The gallery block preview displays images according to the selected ratio for an even more realistic preview experience.
			</div>
		</div>

		<figure class="release-box bg-light grid place-items-center" style="grid-area: figure2">
			<img src="<?= $page->image('gallery-block-2.png')?->url() ?>" loading="lazy" alt="The card design shows the new rounded corners that have been introduced throughout the Panel" style="--aspect-ratio: 1874/694">
		</figure>
	</div>

</section>
