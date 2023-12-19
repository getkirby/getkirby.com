<style>
.v37-search-grid {
	display: grid;
	grid-gap: var(--spacing-6);
	grid-template-columns: 1fr;
	grid-template-areas: "figure"
											 "box1"
											 "box2";
}

@media screen and (min-width: 45rem) {
	.v37-search-grid {
		grid-template-columns: 1fr 1fr;
		grid-template-areas: "figure figure"
												"box1 box2";
	}
}

@media screen and (min-width: 90rem) {
	.v37-search-grid {
		grid-template-columns: 1fr 1fr 1fr;
		grid-template-areas: "box1 figure figure"
												"box2 figure figure";
	}
}
</style>
<section id="section-search" class="mb-42">
	<?php snippet('hgroup', [
		'title'    => 'New section search',
		'subtitle' => 'Speedy filtering of pages and files',
		'mb'       => 12
	]) ?>

	<div class="v37-search-grid">
		<div class="release-text-box" style="grid-area: box1">
			<div class="prose">
				Find the page or file you are looking for in an instant, no more clicking through long lists.
			</div>
		</div>
		<div class="release-padded-box bg-light grid items-end" style="grid-area: figure; padding-bottom: 0">
			<figure style="--aspect-ratio: 2062/1345">
				<img src="<?= ($image = $page->image('search.png'))->url() ?>" loading="lazy" alt="The new section search appears above the pages or files section when you click on the search button next to the add button.">
			</figure>
		</div>
		<div class="release-code-box" style="grid-area: box2">
			<?= $page->sectionSearch()->kt() ?>
		</div>
	</div>
</section>
