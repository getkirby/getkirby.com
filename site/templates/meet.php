<?php layout() ?>
<?php snippet('templates/meet/events.css') ?>

<style>
@media (max-width: 40rem) {
	.events header {
		flex-direction: column;
		gap: 1rem;
		align-items: flex-start;
	}
	.events ul a {
		flex-direction: column;
		gap: var(--spaccing-1);
		align-items: flex-start;
	}
}
</style>

<article>
	<header class="max-w-xl mb-24">
		<h1 class="h1 mb-6">Get together</h1>
		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>
	</header>

	<?php snippet('templates/meet/upcoming', ['events' => $upcoming]) ?>
	<?php snippet('templates/meet/map') ?>
	<?php snippet('templates/meet/how-to') ?>
	<?php snippet('templates/meet/gallery', ['gallery' => $page->gallery()]) ?>
	<?php snippet('templates/meet/past', ['events' => $past]) ?>
</article>

<?php snippet('templates/meet/events.js') ?>
