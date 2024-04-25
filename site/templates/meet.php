<?php layout() ?>

<article>
	<header class="max-w-xl mb-24">
		<h1 class="h1 mb-6">Get together</h1>
		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>
	</header>

	<?php snippet('templates/meet/events', ['events' => $events]) ?>
	<?php snippet('templates/meet/map') ?>
	<?php snippet('templates/meet/how-to') ?>
	<?php snippet('templates/meet/gallery', ['gallery' => $gallery]) ?>
</article>

